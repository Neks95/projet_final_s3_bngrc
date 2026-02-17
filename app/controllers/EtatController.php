<?php
namespace app\controllers;
use app\models\EtatDbservice;
use Flight;

class EtatController{

    function rollback(){
        $model = new EtatDbservice(Flight::db());
        $model->rollback();
    }
}

?>