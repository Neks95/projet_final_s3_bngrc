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


    private function calculerMontant(float $attribue, array $besoin, float $frais): float {
        if (strtolower($besoin['nom_type']) === 'argent') {
            return $attribue; // La quantité attribuée EST le montant
        }
        return $attribue * (float)$besoin['prix_unitaire'] * (1 + $frais / 100);
    }

    public function simulateDispatchParVille(float $frais = 0.0): array {
        $besoins = $this->getBesoinsPrioritaires();
        $dons = $this->getDonsDisponibles();

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

                $montant = $this->calculerMontant($attribue, $b, $frais);

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

        $donsRestants = [];
        foreach ($donsParType as $typeId => $dons_list) {
            $donsRestants[$typeId] = [];
            foreach ($dons_list as $d) {
                $donsRestants[$typeId][] = [
                    'id_don' => $d['id_don'],
                    'qte' => $d['stock_restant']
                ];
            }
        }

        return ['dispatch' => $dispatch, 'donsRestants' => $donsRestants];
    }

    public function simulateDispatchPlusPetit(float $frais = 0.0): array {
        $besoins = $this->getBesoinsPrioritaires();
        $dons = $this->getDonsDisponibles();

        // Trier les besoins par quantité restante croissante
        usort($besoins, function($a, $b) {
            return (float)$a['besoin_restant'] - (float)$b['besoin_restant'];
        });

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

                $montant = $this->calculerMontant($attribue, $b, $frais);

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

        $donsRestants = [];
        foreach ($donsParType as $typeId => $dons_list) {
            $donsRestants[$typeId] = [];
            foreach ($dons_list as $d) {
                $donsRestants[$typeId][] = [
                    'id_don' => $d['id_don'],
                    'qte' => $d['stock_restant']
                ];
            }
        }

        return ['dispatch' => $dispatch, 'donsRestants' => $donsRestants];
    }

    public function simulateDispatchProportionnel(float $frais = 0.0): array {
        $besoins = $this->getBesoinsPrioritaires();
        $dons = $this->getDonsDisponibles();

        $donsParType = [];
        $stockTotalParType = [];
        foreach ($dons as $d) {
            $d['stock_restant'] = (float)$d['stock_restant'];
            $d['qte_initiale'] = (float)$d['qte_initiale'];
            $donsParType[$d['id_type']][] = $d;

            if (!isset($stockTotalParType[$d['id_type']])) {
                $stockTotalParType[$d['id_type']] = 0;
            }
            $stockTotalParType[$d['id_type']] += $d['stock_restant'];
        }

        $besoinsParType = [];
        $sommeBesoinParType = [];
        foreach ($besoins as $b) {
            $typeId = $b['id_type'];
            $besoinsParType[$typeId][] = $b;

            if (!isset($sommeBesoinParType[$typeId])) {
                $sommeBesoinParType[$typeId] = 0;
            }
            $sommeBesoinParType[$typeId] += (float)$b['besoin_restant'];
        }

        $dispatch = [];
        $frais = max(0.0, $frais);

        foreach ($besoinsParType as $typeId => $besoinsDuType) {
            $sommeBesoin = $sommeBesoinParType[$typeId];
            $stockDispo = $stockTotalParType[$typeId] ?? 0;
            $stockADistribuer = min($stockDispo, $sommeBesoin);

            // PHASE 1 : Calculer les attributions avec round()
            $attributions = [];
            $totalAttribue = 0;

            foreach ($besoinsDuType as $index => $b) {
                $besoinRestant = (float)$b['besoin_restant'];

                if ($sommeBesoin > 0) {
                    $attribue = (int)round(($besoinRestant / $sommeBesoin) * $stockADistribuer);
                    $attribue = min($attribue, (int)$besoinRestant);
                } else {
                    $attribue = 0;
                }

                $attributions[$index] = $attribue;
                $totalAttribue += $attribue;
            }

            // PHASE 2 : Correction si round() a sur-attribué
            if ($totalAttribue > $stockADistribuer) {
                $excedent = $totalAttribue - (int)$stockADistribuer;

                $indices = array_keys($attributions);
                usort($indices, function($a, $b) use ($attributions) {
                    return $attributions[$b] - $attributions[$a];
                });

                foreach ($indices as $idx) {
                    if ($excedent <= 0) break;
                    if ($attributions[$idx] > 0) {
                        $attributions[$idx]--;
                        $excedent--;
                    }
                }
            }

            // PHASE 3 : Distribution concrète depuis les dons (FIFO)
            $donsLocaux = $donsParType[$typeId] ?? [];

            foreach ($besoinsDuType as $index => $b) {
                $besoinInitial = (float)$b['besoin_initial'];
                $besoinRestant = (float)$b['besoin_restant'];
                $qteAAttribuer = $attributions[$index];

                if ($qteAAttribuer <= 0 || empty($donsLocaux)) {
                    $resteGlobalType = 0;
                    foreach ($donsLocaux as $d_row) {
                        $resteGlobalType += $d_row['stock_restant'];
                    }

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
                        'reste_don_type'      => $resteGlobalType,
                    ];
                    continue;
                }

                $resteAAttribuer = $qteAAttribuer;

                foreach ($donsLocaux as &$don) {
                    if ($resteAAttribuer <= 0) break;
                    if ($don['stock_restant'] <= 0) continue;

                    $pris = min($resteAAttribuer, $don['stock_restant']);
                    $resteAAttribuer -= $pris;
                    $don['stock_restant'] -= $pris;

                    $montant = $this->calculerMontant($pris, $b, $frais);

                    $resteGlobalType = 0;
                    foreach ($donsLocaux as $d_row) {
                        $resteGlobalType += $d_row['stock_restant'];
                    }

                    $dispatch[] = [
                        'id_besoin'           => $b['id_besoin'],
                        'ville'               => $b['ville'],
                        'type'                => $b['nom_type'],
                        'id_type'             => $typeId,
                        'qte_besoin_ville'    => $besoinInitial,
                        'attribue'            => $pris,
                        'montant'             => $montant,
                        'don_id'              => $don['id_don'],
                        'reste_besoin_ville'  => $besoinRestant - ($qteAAttribuer - $resteAAttribuer),
                        'total_don_init_type' => $don['qte_initiale'],
                        'reste_don_ce_don'    => $don['stock_restant'],
                        'reste_don_type'      => $resteGlobalType,
                    ];
                }
                unset($don);
            }

            $donsParType[$typeId] = $donsLocaux;
        }

        $donsRestants = [];
        foreach ($donsParType as $typeId => $dons_list) {
            $donsRestants[$typeId] = [];
            foreach ($dons_list as $d) {
                $donsRestants[$typeId][] = [
                    'id_don' => $d['id_don'],
                    'qte' => $d['stock_restant']
                ];
            }
        }

        return ['dispatch' => $dispatch, 'donsRestants' => $donsRestants];
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