<?php
namespace app\controllers;
use app\models;
use app\models\Categorie;
use app\models\don;
use Flight;

class CategorieController{
    function getAll(){
        $model = new Categorie(Flight::db());
        return $model->getAll();
    }
    

}

?>