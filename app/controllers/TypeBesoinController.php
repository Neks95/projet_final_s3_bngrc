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

    function create() {

    header('Content-Type: application/json');

    try {

        if (empty($_POST['nom_type'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Le nom du type est obligatoire.'
            ]);
            return;
        }

        $nom_type = trim($_POST['nom_type']);
        $unite    = isset($_POST['unite']) ? trim($_POST['unite']) : null;
        $categ    = !empty($_POST['categ']) ? (int)$_POST['categ'] : null;
        $pu = !empty($_POST['prix']) ? (int)$_POST['prix'] : null;

        $db = Flight::db();

        $model = new TypeBesoin($db);

        $id_insert = $model->create($nom_type, $unite, $categ,$pu);

        if (!$id_insert) {
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de l’insertion.'
            ]);
            return;
        }

        echo json_encode([
            'success'   => true,
            'id'        => $id_insert,
            'nom_type'  => $nom_type
        ]);

    } catch (\Exception $e) {

        echo json_encode([
            'success' => false,
            'message' => 'Erreur serveur : ' . $e->getMessage()
        ]);
    }
}


}

?>