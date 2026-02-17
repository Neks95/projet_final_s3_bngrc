<?php

    namespace app\models;
    use PDO;

    class Categorie {

        private $db;

        public function __construct($db) {
            $this -> db = $db;
        }
        
        public  function getAll() {
            $stmt = $this->db->query("SELECT id, nom_categorie FROM categorie");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

       
    
 
    }

?>