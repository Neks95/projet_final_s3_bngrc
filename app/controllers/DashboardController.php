<?php
namespace app\controllers;


use Flight;

use app\models\dashboard;

class DashboardController {

    public function index(){

        $model = new Dashboard(\Flight::db());

        $nbVille = $model->countVille();
        $totalBesoins = $model->totalBesoins();
        $totalDons = $model->totalDons();
        $recapVille = $model->recapVille();
        $lastDons = $model->lastDons();
        $lastAttrib = $model->lastAttributions();

        Flight::render('index', [
            'nbVille' => $nbVille,
            'totalBesoins' => $totalBesoins,
            'totalDons' => $totalDons,
            'recapVille' => $recapVille,
            'lastDons' => $lastDons,
            'lastAttrib' => $lastAttrib
        ]);
    }
}
