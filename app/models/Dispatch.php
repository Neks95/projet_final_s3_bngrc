<?php

namespace app\models;

use Flight;
use PDO;

class Dispatch
{
    public function getBesoinsPrioritaires() {
        $sql = "
            SELECT 
                b.id as id_besoin,
                b.date_saisie,
                v.nom as ville,
                tb.nom_type,
                tb.id as id_type,
                b.qte_besoin_ville as besoin_initial,
                tb.prix_unitaire,
                (b.qte_besoin_ville - COALESCE(
                    (SELECT SUM(h.qte) FROM historique h WHERE h.id_besoin = b.id), 0)
                ) as besoin_restant
            FROM besoin b
            JOIN ville v ON b.id_ville = v.id
            JOIN type_besoin tb ON b.id_type = tb.id
            WHERE (b.qte_besoin_ville - COALESCE((SELECT SUM(h.qte) FROM historique h WHERE h.id_besoin = b.id), 0)) > 0
            ORDER BY b.date_saisie ASC, b.id ASC
        ";
        return Flight::db()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDonsDisponibles() {
        $sql = "
            SELECT 
                d.id as id_don,
                d.id_type,
                tb.nom_type,
                d.qte as qte_initiale,
                (d.qte - COALESCE(
                    (SELECT SUM(h.qte) FROM historique h WHERE h.id_don = d.id), 0)
                ) as stock_restant
            FROM don d
            JOIN type_besoin tb ON d.id_type = tb.id
            WHERE (d.qte - COALESCE((SELECT SUM(h.qte) FROM historique h WHERE h.id_don = d.id), 0)) > 0
            ORDER BY d.date_saisie ASC, d.id ASC
        ";
        return Flight::db()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function simulateDispatchParVille(float $frais = 0.0): array {
        $besoins = $this->getBesoinsPrioritaires();
        $dons = $this->getDonsDisponibles();

        // Indexer les dons par type
        $donsParType = [];
        foreach ($dons as $d) {
            $d['stock_restant'] = (float)$d['stock_restant'];
            $d['qte_initiale'] = (float)$d['qte_initiale'];
            $donsParType[$d['id_type']][] = $d;
        }

        $dispatch = [];
        $frais = max(0.0, $frais);

        foreach ($besoins as $b) {
            $typeId = $b['id_type'];
            $besoinInitial = (float)$b['besoin_initial'];
            $besoinRestant = (float)$b['besoin_restant'];

            if (!isset($donsParType[$typeId]) || empty($donsParType[$typeId])) {
                $dispatch[] = [
                    'id_besoin'           => $b['id_besoin'],
                    'ville'               => $b['ville'],
                    'type'                => $b['nom_type'],
                    'id_type'             => $typeId,
                    'qte_besoin_ville'    => $besoinInitial,
                    'attribue'            => 0,
                    'montant'             => 0,
                    'don_id'              => null,
                    'reste_besoin_ville'  => $besoinRestant,
                    'total_don_init_type' => 0,
                    'reste_don_ce_don'    => 0,
                    'reste_don_type'      => 0,
                ];
                continue;
            }

            foreach ($donsParType[$typeId] as &$don) {
                if ($besoinRestant <= 0) break;
                if ($don['stock_restant'] <= 0) continue;

                $attribue = min($besoinRestant, $don['stock_restant']);
                $besoinRestant -= $attribue;
                $don['stock_restant'] -= $attribue;

                $montant = $attribue * (float)$b['prix_unitaire'] * (1 + $frais / 100);

                // Reste global pour ce type
                $resteGlobalType = 0;
                foreach ($donsParType[$typeId] as $d_row) {
                    $resteGlobalType += $d_row['stock_restant'];
                }

                $dispatch[] = [
                    'id_besoin'           => $b['id_besoin'],
                    'ville'               => $b['ville'],
                    'type'                => $b['nom_type'],
                    'id_type'             => $typeId,
                    'qte_besoin_ville'    => $besoinInitial,
                    'attribue'            => $attribue,
                    'montant'             => $montant,
                    'don_id'              => $don['id_don'],
                    'reste_besoin_ville'  => $besoinRestant,
                    'total_don_init_type' => $don['qte_initiale'],
                    'reste_don_ce_don'    => $don['stock_restant'],
                    'reste_don_type'      => $resteGlobalType,
                ];
            }
            unset($don);
        }

        return ['dispatch' => $dispatch];
    }

    public function saveAttribution($idDon, $idBesoin, $qte, $dateMvt)
    {
        $sql = "INSERT INTO historique (id_don, id_besoin, qte, date_mvt) 
                VALUES (:id_don, :id_besoin, :qte, :date_mvt)";
        $stmt = Flight::db()->prepare($sql);
        $stmt->execute([
            ':id_don'    => $idDon,
            ':id_besoin' => $idBesoin,
            ':qte'       => $qte,
            ':date_mvt'  => $dateMvt
        ]);
    }
}
