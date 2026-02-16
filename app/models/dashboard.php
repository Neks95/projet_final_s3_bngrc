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
        $sql = "SELECT SUM(b.qte_besoin_ville * t.prix_unitaire) as total
                FROM besoin b
                JOIN type_besoin t ON b.id_type = t.id";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function totalDons(){
        $sql = "SELECT SUM(d.qte * t.prix_unitaire) as total
                FROM don d
                JOIN type_besoin t ON d.id_type = t.id";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function recapVille(){
        $sql = "
            SELECT v.nom,
                   SUM(b.qte_besoin_ville * t.prix_unitaire) as total_besoin,
                   SUM(h.qte * t.prix_unitaire) as total_attribue
            FROM ville v
            LEFT JOIN besoin b ON v.id = b.id_ville
            LEFT JOIN type_besoin t ON b.id_type = t.id
            LEFT JOIN historique h ON b.id = h.id_besoin
            GROUP BY v.id
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastDons(){
        $sql = "
            SELECT d.qte, d.date_saisie, t.nom_type, t.prix_unitaire
            FROM don d
            JOIN type_besoin t ON d.id_type = t.id
            ORDER BY d.date_saisie DESC
            LIMIT 4
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastAttributions(){
        $sql = "
            SELECT h.qte, h.date_mvt, v.nom as ville, 
                   t.nom_type, t.prix_unitaire
            FROM historique h
            JOIN besoin b ON h.id_besoin = b.id
            JOIN ville v ON b.id_ville = v.id
            JOIN type_besoin t ON b.id_type = t.id
            ORDER BY h.date_mvt DESC
            LIMIT 4
        ";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
