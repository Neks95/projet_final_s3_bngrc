<?php
namespace app\models;
use PDO;

class TypeBesoin {
    private $db;

    public function __construct($db) {
        $this -> db = $db;
    }

    public  function create($nom_type, $unite, $id_categorie) {
        $sql = "INSERT INTO type_besoin (nom_type, unite, id_categorie) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nom_type, $unite, $id_categorie]);
    }

    public function getAll(){
        $sql = "SELECT id,nom_type FROM type_besoin";
        $stmt = $this->db->prepare($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>