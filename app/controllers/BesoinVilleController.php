<?php
namespace app\controllers;
use app\models\besoinVille;
use Flight;

class BesoinVilleController{

    function getAllBesoin(){
        $model = new besoinVille(Flight::db());
        return $model->getAll();

    }

    function insererBesoin(){
        $model = new besoinVille(Flight::db());
        $ville = $_POST['ville'];
        $type = $_POST['type'];
        $qt = $_POST['quantite'];
        $model ->insert($ville,$type,$qt);
        Flight::redirect('/gestion_besoin');
    }

     public function getBesoinsRestant($id_ville = null)
    {
        $model = new besoinVille(Flight::db());
        return $model->getBesoinsRestant($id_ville);
    }

   

}

?>