<?php 
namespace app\controllers;

use app\models\Ville;
use flight\Engine;
use Flight;

class VilleController{
    public function __construct() {
        // Constructor code here
    }

    public function getAllVille(){
        $ville = new Ville(Flight::db());
        return $villes = $ville->getAllVille();
    }

    public function insertVille() {
        $nom    = trim($_POST['nom']    ?? '');
        $region = trim($_POST['region'] ?? '');

        $model = new Ville(Flight::db());
        $model->insertVille($nom, $region);

        Flight::redirect('/villes');
    }

    public function countVille() {
        return (new Ville(Flight::db()))->countVille();
    }
}
?>