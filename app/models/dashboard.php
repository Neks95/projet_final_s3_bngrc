<?php
namespace app\models;

use PDO;

class Dashboard {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function countVille(){
        $sql = "SELECT COUNT(*) as total FROM ville";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function totalBesoins(){
        $sql = "
            SELECT 
                IFNULL(SUM(
                    CASE 
                        WHEN t.id_categorie = 3 -- Catégorie Argent
                        THEN b.qte_besoin_ville
                        ELSE b.qte_besoin_ville * t.prix_unitaire
                    END
                ), 0) as total
            FROM besoin b
            JOIN type_besoin t ON b.id_type = t.id
        ";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function totalDons(){
        $sql = "
            SELECT 
                IFNULL(SUM(
                    CASE 
                        WHEN t.id_categorie = 3 -- Catégorie Argent
                        THEN d.qte
                        ELSE d.qte * t.prix_unitaire
                    END
                ), 0) as total
            FROM don d
            JOIN type_besoin t ON d.id_type = t.id
        ";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function recapVille(){
        $sql = "
            SELECT 
                v.nom,
                
                -- Total des besoins par ville
                IFNULL(SUM(
                    CASE 
                        WHEN t.id_categorie = 3
                        THEN b.qte_besoin_ville
                        ELSE b.qte_besoin_ville * t.prix_unitaire
                    END
                ), 0) as total_besoin,
                
                -- Total des attributions par ville
                IFNULL(SUM(
                    CASE 
                        WHEN t.id_categorie = 3
                        THEN h.qte
                        ELSE h.qte * t.prix_unitaire
                    END
                ), 0) as total_attribue
                
            FROM ville v
            LEFT JOIN besoin b ON v.id = b.id_ville
            LEFT JOIN type_besoin t ON b.id_type = t.id
            LEFT JOIN historique h ON b.id = h.id_besoin
            GROUP BY v.id, v.nom
            ORDER BY v.nom
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastDons(){
        $sql = "
            SELECT 
                d.qte, 
                d.date_saisie, 
                t.nom_type, 
                t.prix_unitaire,
                t.id_categorie,
                c.nom_categorie,
                
                -- Calcul du montant
                CASE 
                    WHEN t.id_categorie = 3
                    THEN d.qte
                    ELSE d.qte * t.prix_unitaire
                END as montant_total
                
            FROM don d
            JOIN type_besoin t ON d.id_type = t.id
            JOIN categorie c ON t.id_categorie = c.id
            ORDER BY d.date_saisie DESC
            LIMIT 4
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    public function lastAttributions(){
        $sql = "
            SELECT 
                h.qte, 
                h.date_mvt, 
                v.nom as ville, 
                t.nom_type, 
                t.prix_unitaire,
                t.id_categorie,
                c.nom_categorie,
                
                -- Calcul du montant
                CASE 
                    WHEN t.id_categorie = 3
                    THEN h.qte
                    ELSE h.qte * t.prix_unitaire
                END as montant_total
                
            FROM historique h
            JOIN besoin b ON h.id_besoin = b.id
            JOIN ville v ON b.id_ville = v.id
            JOIN type_besoin t ON b.id_type = t.id
            JOIN categorie c ON t.id_categorie = c.id
            ORDER BY h.date_mvt DESC
            LIMIT 4
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}