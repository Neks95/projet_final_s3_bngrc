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

    public function simulateDispatchParVille() {
        $besoins = $this->getBesoins();
        $dons = $this->getDons();

        // Organiser les dons par type
        $donsParType = [];
        foreach ($dons as $d) {
            $donsParType[$d['id_type']][] = [
                'id_don' => $d['id_don'],
                'qte' => $d['qte']
            ];
        }

        $dispatch = [];

        foreach ($besoins as $b) {
            $besoinVille = $b['qte_besoin_ville'];

            // Total disponible pour ce type
            $totalDonDisponible = 0;
            if (isset($donsParType[$b['id_type']])) {
                foreach ($donsParType[$b['id_type']] as $d) {
                    $totalDonDisponible += $d['qte'];
                }
            }

            // Attribution : si on peut satisfaire tout le besoin, on le fait
            $attribueVille = min($besoinVille, $totalDonDisponible);
            $resteBesoin = $attribueVille;

            if (isset($donsParType[$b['id_type']])) {
                foreach ($donsParType[$b['id_type']] as &$d) {
                    if ($resteBesoin <= 0) break;
                    $donAttribue = min($d['qte'], $resteBesoin);

                    $dispatch[] = [
                        'ville' => $b['ville'],
                        'type' => $b['nom_type'],
                        'id_type' => $b['id_type'],          
                        'qte_besoin_ville' => $besoinVille,
                        'attribue' => $donAttribue,
                        'montant' => $donAttribue * $b['prix_unitaire'],
                        'don_id' => $d['id_don'],
                        'reste_don_apres' => $d['qte'] - $donAttribue
                    ];

                    // Mise à jour du don et reste besoin
                    $d['qte'] -= $donAttribue;
                    $resteBesoin -= $donAttribue;
                }
            }
        }

        return $dispatch;
    }
}
