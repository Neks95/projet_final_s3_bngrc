<?php
namespace app\models;

use PDO;
use Flight;

class Dispatch {

    private $db;

    public function __construct() {
        $this->db = Flight::db();
    }

    public function getBesoins() {
        $sql = "
            SELECT b.id as id_besoin, b.id_ville, v.nom as ville, b.id_type, b.qte_besoin_ville,
                   t.nom_type, t.prix_unitaire, b.date_saisie
            FROM besoin b
            JOIN type_besoin t ON b.id_type = t.id
            JOIN ville v ON b.id_ville = v.id
            ORDER BY b.date_saisie ASC, b.id ASC
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDons() {
        $stmt = $this->db->query("
            SELECT d.id as id_don, d.id_type, d.qte, d.date_saisie
            FROM don d
            ORDER BY d.date_saisie ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveAttribution($id_don, $id_besoin, $qte) {
        $stmt = $this->db->prepare("
            INSERT INTO historique (id_don, id_besoin, qte, date_mvt)
            VALUES (?, ?, ?, NOW())
        ");
        return $stmt->execute([$id_don, $id_besoin, $qte]);
    }

    public function simulateDispatchParVille(float $frais = 0.0): array {
        $frais = max(0.0, $frais);

        $besoins = $this->getBesoins();
        $dons = $this->getDons();

        // ── 1. Organiser les dons par type ──
        $donsParType = [];
        foreach ($dons as $d) {
            $donsParType[$d['id_type']][] = [
                'id_don'   => $d['id_don'],
                'qte_init' => (int)$d['qte'],   // quantité initiale du don
                'qte'      => (int)$d['qte'],   // quantité restante (va décroître)
            ];
        }

        // ── 2. Calculer le total initial des dons par type ──
        $totalDonsInitParType = [];
        foreach ($donsParType as $typeId => $rows) {
            $totalDonsInitParType[$typeId] = array_sum(array_column($rows, 'qte_init'));
        }

        // ── 3. Simuler les attributions ──
        $dispatch = [];

        foreach ($besoins as $b) {
            $besoinVille = (int)$b['qte_besoin_ville'];
            $resteBesoin = $besoinVille;
            $typeId      = $b['id_type'];

            if (!isset($donsParType[$typeId])) continue;

            foreach ($donsParType[$typeId] as &$don) {
                if ($resteBesoin <= 0) break;
                if ($don['qte'] <= 0) continue;

                $attribue = min($don['qte'], $resteBesoin);

                // Décrémenter le don AVANT de calculer le reste
                $don['qte']  -= $attribue;
                $resteBesoin -= $attribue;

                // Calculer le reste GLOBAL du don pour ce type (tous les dons de ce type)
                $resteDonGlobalType = 0;
                foreach ($donsParType[$typeId] as $row) {
                    $resteDonGlobalType += $row['qte'];
                }

                $montant = $attribue * (float)$b['prix_unitaire'] * (1 + $frais / 100);

                $dispatch[] = [
                    'id_besoin'           => $b['id_besoin'],
                    'ville'               => $b['ville'],
                    'type'                => $b['nom_type'],
                    'id_type'             => $typeId,
                    'qte_besoin_ville'    => $besoinVille,
                    'attribue'            => $attribue,
                    'montant'             => $montant,
                    'don_id'              => $don['id_don'],
                    'reste_besoin_ville'  => $resteBesoin,
                    // ── Données clés pour le détail ──
                    'total_don_init_type' => $totalDonsInitParType[$typeId],     // total initial de tous les dons de ce type
                    'reste_don_ce_don'    => $don['qte'],                        // reste de CE don précis
                    'reste_don_type'      => $resteDonGlobalType,                // reste GLOBAL de tous les dons de ce type
                ];
            }
            unset($don);
        }

        // ── 4. Dons restants par type après toutes les attributions ──
        $donsRestants = [];
        foreach ($donsParType as $typeId => $rows) {
            foreach ($rows as $row) {
                $donsRestants[$typeId][] = [
                    'id_don'   => $row['id_don'],
                    'qte_init' => $row['qte_init'],
                    'qte'      => $row['qte'],
                ];
            }
        }

        return [
            'dispatch'             => $dispatch,
            'donsRestants'         => $donsRestants,
            'totalDonsInitParType' => $totalDonsInitParType,
        ];
    }
}