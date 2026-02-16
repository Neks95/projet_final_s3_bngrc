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
         $stmt = $this->db->prepare("INSERT INTO ville (nom, region) VALUES (?,?)");
        return $stmt->execute([$nom,$region]);
    }

    public function getAllVille(){
        $stmt = $this->db->query("SELECT * FROM ville");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countVille() {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM ville");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}
?>