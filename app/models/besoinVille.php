<?php

namespace app\models;

use PDO;

class besoinVille
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    function getAll()
    {
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

    function getById($id)
    {
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

    function getByVille($id_ville)
    {
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

    function insert($id_ville, $id_type, $qte_besoin_ville)
    {


        $sql = "INSERT INTO besoin (id_ville, id_type, qte_besoin_ville,date_saisie) 
                VALUES ( ?, ? , ? ,NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ville, $id_type, $qte_besoin_ville]);
        return $this->db->lastInsertId();
    }



    // Statistiques par ville

    public function getBesoinsRestant($id_ville = null)
    {
        $sql = "SELECT * FROM view_besoins_restants WHERE qte_restant > 0";
        $params = [];

        if (!empty($id_ville)) {
            $sql .= " AND id_ville = ?";
            $params[] = (int)$id_ville;
        }
        $sql .= " ORDER BY qte_restant DESC, qte_demande DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
