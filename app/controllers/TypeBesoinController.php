<?php
namespace app\controllers;
use app\models;
use app\models\TypeBesoin;
use Flight;

class TypeBesoinController{
    function getAlltype(){
        $model = new TypeBesoin(Flight::db());
        return $model->getAll();

    }

}

?>