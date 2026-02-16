<?php

    namespace app\models;

    class Categorie {

        private $db;

        public function __construct($db) {
            $this -> db = $db;
        }
        
        public static function getAll() {
            $db = Database::connect();
            $stmt = $db->query("SELECT id, nom_categorie FROM categorie");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
 
    }

?>