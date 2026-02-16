<?php
namespace app\controllers;
use app\models\Ville;
use Flight;

class VilleController{

    function getAllVille(){
        $model = new Ville(Flight::db());
        return $model->getAllVille();

    }

}

?>