<?php 
namespace app\models;

use flight\Engine;
use PDO;

class Ville{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function insertVille($nom, $region){
         $stmt = $this->db->prepare("INSERT INTO ville (nom, region) VALUES (:nom, :region)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':region', $region);
        return $stmt->execute();
    }

    public function getAllVille(){
        $stmt = $this->db->query("SELECT * FROM ville");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>