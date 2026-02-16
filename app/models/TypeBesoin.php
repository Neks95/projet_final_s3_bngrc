<?php
namespace app\models;
use PDO;

class TypeBesoin {
    private $db;

    public function __construct($db) {
        $this -> db = $db;
    }

    public  function create($nom_type, $unite, $id_categorie,$pu) {
        $sql = "INSERT INTO type_besoin (nom_type, unite, id_categorie,prix_unitaire) VALUES (?, ?, ?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nom_type, $unite, $id_categorie,$pu]);
        return $this->db->lastInsertId();
    }

    public function getAll(){
        $sql = "SELECT id,nom_type FROM type_besoin";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>