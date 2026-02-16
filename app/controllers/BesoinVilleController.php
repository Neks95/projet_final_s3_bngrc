<?php
namespace app\controllers;
use app\models\besoinVille;
use Flight;

class BesoinVilleController{

    function getAllBesoin(){
        $model = new besoinVille(Flight::db());
        return $besoins = $model->getAll();

    }

}

?>