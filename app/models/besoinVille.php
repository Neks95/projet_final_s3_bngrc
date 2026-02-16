<?php 

namespace app\models;

use PDO;

class besoinVille {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function getAll() {
        $sql = "SELECT 
                b.id,
                b.id_ville,
                b.id_type,
                v.nom AS ville,
                v.region,
                t.nom_type,
                t.unite,
                t.prix_unitaire,
                c.nom_categorie,
                b.qte_besoin_ville,
                b.date_saisie
                FROM besoin b
                JOIN ville v ON b.id_ville = v.id
                JOIN type_besoin t ON b.id_type = t.id
                JOIN categorie c ON t.id_categorie = c.id
                GROUP BY b.id
                ORDER BY b.date_saisie DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getById($id) {
        $sql = "SELECT 
                b.*,
                v.nom AS ville,
                v.region,
                t.nom_type,
                t.unite,
                c.nom_categorie
                FROM besoin b
                JOIN ville v ON b.id_ville = v.id
                JOIN type_besoin t ON b.id_type = t.id
                JOIN categorie c ON t.id_categorie = c.id
                WHERE b.id = ?
                GROUP BY b.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getByVille($id_ville) {
        $sql = "SELECT 
                b.*,
                t.nom_type,
                t.unite,
                c.nom_categorie
                FROM besoin b
                JOIN type_besoin t ON b.id_type = t.id
                JOIN categorie c ON t.id_categorie = c.id
                WHERE b.id_ville = ?
                GROUP BY b.id
                ORDER BY b.date_saisie DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ville]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function insert($id_ville, $id_type, $qte_besoin_ville) {
       
        
        $sql = "INSERT INTO besoin (id_ville, id_type, qte_besoin_ville,date_saisie) 
                VALUES ( ?, ? , ? ,NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ville,$id_type,$qte_besoin_ville]);
        return $this->db->lastInsertId();
    }



    // Statistiques par ville
    function getStatsByVille() {
        $sql = "SELECT 
                v.id,
                v.nom AS ville,
                v.region,cb
                COUNT(b.id) AS nb_besoins,
                SUM(b.qte_besoin_ville * b.prix_unitaire) AS valeur_totale,
                SUM(IFNULL(h.qte, 0) * b.prix_unitaire) AS valeur_satisfaite
                FROM ville v
                LEFT JOIN besoin b ON v.id = b.id_ville
                LEFT JOIN historique h ON b.id = h.id_besoin
                GROUP BY v.id
                ORDER BY valeur_totale DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>