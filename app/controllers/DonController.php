<?php
namespace app\controllers;
use app\models;
use app\models\don;
use Flight;

class DonController{
    function getAll(){
        $model = new don(Flight::db());
        return $model->getAll();

    }
    function insert(){
        $qte = $_POST['qte'];
        $id_type = $_POST['id_type'];
        $model = new don(Flight::db());;
        $model->insert($id_type,$qte);
        Flight::redirect('/gestion_don');

    }

}

?>