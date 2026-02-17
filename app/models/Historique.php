<?php 
namespace app\models;

use PDO;

class Historique {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Récupère le récapitulatif global
     * Gère les besoins en nature/matériaux ET en argent
     */
    public function getBesoinsRestantParVille()
    {
        $sql = "
            SELECT 
                -- Montant total des besoins
                -- Si catégorie = argent (id 3), qte_besoin = montant direct
                -- Sinon, qte_besoin * prix_unitaire
                IFNULL(SUM(
                    CASE 
                        WHEN c.nom_categorie = 'Argent' OR t.prix_unitaire IS NULL OR t.prix_unitaire = 0
                        THEN b.qte_besoin_ville
                        ELSE b.qte_besoin_ville * t.prix_unitaire
                    END
                ), 0) AS montant_total,

                -- Montant satisfait (depuis historique)
                IFNULL(SUM(
                    CASE 
                        WHEN c.nom_categorie = 'Argent' OR t.prix_unitaire IS NULL OR t.prix_unitaire = 0
                        THEN h.total_dispatch
                        ELSE h.total_dispatch * t.prix_unitaire
                    END
                ), 0) AS montant_satisfait,

                -- Montant restant
                IFNULL(SUM(
                    CASE 
                        WHEN c.nom_categorie = 'Argent' OR t.prix_unitaire IS NULL OR t.prix_unitaire = 0
                        THEN (b.qte_besoin_ville - IFNULL(h.total_dispatch, 0))
                        ELSE (b.qte_besoin_ville - IFNULL(h.total_dispatch, 0)) * t.prix_unitaire
                    END
                ), 0) AS montant_restant

            FROM besoin b
            JOIN type_besoin t ON b.id_type = t.id
            JOIN categorie c ON t.id_categorie = c.id
            LEFT JOIN (
                SELECT 
                    id_besoin, 
                    SUM(qte) AS total_dispatch
                FROM historique
                GROUP BY id_besoin
            ) h ON b.id = h.id_besoin
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>