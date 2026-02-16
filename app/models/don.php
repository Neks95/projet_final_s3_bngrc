<?php

namespace app\models;

class Don {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($id_type, $qte ,$date_saisie) {
        $sql = "INSERT INTO don (id_type, qte, date_saisie) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_type, $qte, $date_saisie]);
    }

    public function getAll() {
        $sql = "SELECT d.id, d.qte, d.date_saisie, tb.nom_type, tb.unite
                FROM don d
                JOIN type_besoin tb ON d.id_type = tb.id
                ORDER BY d.date_saisie DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>
