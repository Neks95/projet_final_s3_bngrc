<?php


namespace app\models;


class TypeBesoin {
    private $db;

    public function __construct($db) {
        $this -> db = $db;
    }

    public static function create($nom_type, $unite, $id_categorie) {
        $db = Database::connect();
        $sql = "INSERT INTO type_besoin (nom_type, unite, id_categorie) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$nom_type, $unite, $id_categorie]);
    }


}

?>