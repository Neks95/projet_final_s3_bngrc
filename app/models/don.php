<?php

namespace app\models;

class Don {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insert($id_type, $qte) {
        $sql = "INSERT INTO don (id_type, qte, date_saisie) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_type, $qte]);
    }

    public function getAll() {
        $sql = "SELECT d.id, d.qte, d.date_saisie, tb.nom_type, tb.unite , tb.prix_unitaire
                FROM don d
                JOIN type_besoin tb ON d.id_type = tb.id
                ORDER BY d.date_saisie DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>
