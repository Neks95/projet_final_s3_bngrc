<?php
namespace app\models;
use app\models\Utils;
use PDO;

class AchatService
{
    private $db;
    private $utils;

    public function __construct($db, Utils $utils)
    {
        $this->db = $db;
        $this->utils = $utils;
    }

    public function validateParams(int $id_besoin, float $qte): ?array
    {
        if ($id_besoin <= 0 || $qte <= 0) {
            return ['code' => 400, 'message' => 'Paramètres invalides.'];
        }
        return null;
    }

    public function lockBesoin(int $id_besoin): ?array
    {
        $stmt = $this->db->prepare("SELECT b.id, b.id_type, b.qte_besoin_ville FROM besoin b WHERE b.id = ? FOR UPDATE");
        $stmt->execute([$id_besoin]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        return $row;
    }

    public function getTypeInfo(int $id_type): ?array
    {
        $stmt = $this->db->prepare("SELECT unite, prix_unitaire FROM type_besoin WHERE id = ? LIMIT 1");
        $stmt->execute([$id_type]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        return $row;
    }

    public function computeSatisfiedAndRemaining(int $id_besoin, float $prix_unitaire, float $qte_besoin_total): array
{
    $stmt = $this->db->prepare("
        SELECT
          COALESCE(SUM(CASE WHEN donor_tb.unite = 'ar' THEN h.qte ELSE 0 END),0) AS sum_money,
          COALESCE(SUM(CASE WHEN donor_tb.unite <> 'ar' OR donor_tb.unite IS NULL THEN h.qte ELSE 0 END),0) AS sum_qty
        FROM historique h
        LEFT JOIN don d2 ON d2.id = h.id_don
        LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
        WHERE h.id_besoin = ?
    ");
    $stmt->execute([$id_besoin]);
    $agg = $stmt->fetch(PDO::FETCH_ASSOC) ?: ['sum_money'=>0,'sum_qty'=>0];
    $sum_money = (float)$agg['sum_money'];
    $sum_qty = (float)$agg['sum_qty'];

    $fee = 0.0;
    try {
        $fee = (float) $this->utils->getConfig();
    } catch (\Exception $e) {
        $fee = 0.0;
    }

    $conversion_unit_price = $prix_unitaire * (1 + $fee);

    if ($conversion_unit_price <= 0) {
        $conversion_unit_price = max(1.0, $prix_unitaire);
    }

    $satisfied_from_money_qty = floor($sum_money / $conversion_unit_price);
    $qte_deja_satisfaite = $sum_qty + $satisfied_from_money_qty;
    $qte_restant = max(0, $qte_besoin_total - $qte_deja_satisfaite);

    return [
        'sum_money' => $sum_money,
        'sum_qty' => $sum_qty,
        'fee' => $fee,
        'satisfied_qty' => $qte_deja_satisfaite,
        'qte_restant' => $qte_restant
    ];
}

    public function hasPhysicalDonsRemaining(int $id_type): bool
    {
        $stmt = $this->db->prepare("
            SELECT 1
            FROM don d
            LEFT JOIN (
               SELECT id_don, SUM(h.qte) AS sumq FROM historique h GROUP BY id_don
            ) hs ON hs.id_don = d.id
            JOIN type_besoin tb2 ON d.id_type = tb2.id
            WHERE d.id_type = ? AND tb2.unite <> 'ar' AND (d.qte - COALESCE(hs.sumq,0)) > 0
            LIMIT 1
        ");
        $stmt->execute([$id_type]);
        return (bool)$stmt->fetchColumn();
    }

    public function calculerArgentNecessaire(float $qte_demande, float $prix_unitaire): array
    {
        $fee = $this->utils->getConfig(); 
        $montant_necessaire = $qte_demande * $prix_unitaire * (1 + $fee);
        return ['fee' => $fee, 'montant_necessaire' => $montant_necessaire];
    }

    public function getTotalCashAvailable(): float
    {
        return $this->utils->getTotalArgentDisponible();
    }

    public function getCashDonsForUpdate(): array
    {
        $stmt = $this->db->prepare("
            SELECT d.id AS id_don, d.qte AS qte_origine,
                   COALESCE(SUM(h.qte),0) AS qte_consommee
            FROM don d
            LEFT JOIN historique h ON h.id_don = d.id
            JOIN type_besoin tb ON d.id_type = tb.id
            WHERE tb.unite = 'ar'
            GROUP BY d.id, d.qte
            HAVING (d.qte - COALESCE(SUM(h.qte),0)) > 0
            ORDER BY d.date_saisie ASC
            FOR UPDATE
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allocateFundsAndWriteHistory(int $id_besoin, float $montant_necessaire): array
    {
        $dons = $this->getCashDonsForUpdate();
        $to_take = $montant_necessaire;
        $allocations = [];

        $insStmt = $this->db->prepare("INSERT INTO historique (id_don, id_besoin, qte, date_mvt) VALUES (?, ?, ?, NOW())");

        foreach ($dons as $d) {
            if ($to_take <= 0) break;

            $don_id = (int)$d['id_don'];
            $don_used = (float)($d['qte_consommee'] ?? 0);
            $don_orig = (float)($d['qte_origine'] ?? 0);
            $don_rest = max(0, $don_orig - $don_used);
            if ($don_rest <= 0) continue;

            $take = min($don_rest, $to_take);
            $insStmt->execute([$don_id, $id_besoin, $take]);

            $allocations[] = ['id_don' => $don_id, 'amount_taken' => $take];
            $to_take -= $take;
        }

        if ($to_take > 0.5) {
            throw new \Exception('Montant non complètement alloué.');
        }

        return $allocations;
    }

    public function processPurchase(int $id_besoin, float $qte_demande): array
    {
        // Validate params
        if ($err = $this->validateParams($id_besoin, $qte_demande)) {
            return ['status' => $err['code'], 'body' => ['success'=>false,'message'=>$err['message']]];
        }

        try {
            $this->db->beginTransaction();

            $besoin = $this->lockBesoin($id_besoin);
            if (!$besoin) {
                $this->db->rollBack();
                return ['status'=>404,'body'=>['success'=>false,'message'=>'Besoin introuvable.']];
            }

            $id_type = (int)$besoin['id_type'];
            $qte_besoin_total = (float)$besoin['qte_besoin_ville'];

            $typeInfo = $this->getTypeInfo($id_type);
            if (!$typeInfo) {
                $this->db->rollBack();
                return ['status'=>500,'body'=>['success'=>false,'message'=>'Type introuvable.']];
            }
            $unite = $typeInfo['unite'];
            $prix_unitaire = (float)($typeInfo['prix_unitaire'] ?? 0);
            if ($unite === 'ar') {
                $this->db->rollBack();
                return ['status'=>400,'body'=>['success'=>false,'message'=>'Besoin monétaire — pas d\'achat via dons en argent.']];
            }
            if ($prix_unitaire <= 0) {
                $this->db->rollBack();
                return ['status'=>400,'body'=>['success'=>false,'message'=>'Prix unitaire introuvable pour ce type.']];
            }

            $calc = $this->computeSatisfiedAndRemaining($id_besoin, $prix_unitaire, $qte_besoin_total);
            $qte_restant = $calc['qte_restant'];

            // If nothing remains, return error
            if ($qte_restant <= 0) {
                $this->db->rollBack();
                return ['status'=>400,'body'=>['success'=>false,'message'=>'Aucun restant pour ce besoin.']];
            }

            // Remove strict "max" error: clamp requested quantity to remaining
            $adjusted = false;
            $original_qte = $qte_demande;
            if ($qte_demande > $qte_restant) {
                $qte_demande = $qte_restant;
                $adjusted = true;
            }

            if ($this->hasPhysicalDonsRemaining($id_type)) {
                $this->db->rollBack();
                return ['status'=>409,'body'=>['success'=>false,'message'=>'Il existe encore des dons physiques de ce type. Utilisez-les d\'abord.']];
            }

            $money = $this->calculerArgentNecessaire($qte_demande, $prix_unitaire);
            $fee = $money['fee'];
            $montant_necessaire = $money['montant_necessaire'];

            $total_dispo = $this->getTotalCashAvailable();
            if ($montant_necessaire > $total_dispo) {
                $this->db->rollBack();
                return ['status'=>409,'body'=>[
                    'success'=>false,
                    'message'=>'Fonds insuffisants pour couvrir cet achat.',
                    'details' => ['montant_necessaire'=>$montant_necessaire,'total_disponible'=>$total_dispo,'fee'=>$fee]
                ]];
            }

            $allocations = $this->allocateFundsAndWriteHistory($id_besoin, $montant_necessaire);

            $this->db->commit();

            $msg = 'Achat effectué et enregistré dans l\'historique.';
            if ($adjusted) {
                $msg .= " La quantité demandée ({$original_qte}) a été ajustée à la quantité restante ({$qte_demande}).";
            }

            return ['status'=>200,'body'=>[
                'success'=>true,
                'message'=>$msg,
                'data'=>[
                    'id_besoin'=>$id_besoin,
                    'qte_requested'=>$original_qte,
                    'qte_achetee'=>$qte_demande,
                    'montant_preleve'=>$montant_necessaire,
                    'fee'=>$fee,
                    'allocations'=>$allocations
                ]
            ]];
        } catch (\Exception $e) {
            if ($this->db->inTransaction()) $this->db->rollBack();
            return ['status'=>500,'body'=>['success'=>false,'message'=>'Erreur serveur: '.$e->getMessage()]];
        }
    }
}