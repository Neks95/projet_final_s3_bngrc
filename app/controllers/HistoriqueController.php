<?php

namespace app\controllers;

use app\models\Historique;
use Flight;

class HistoriqueController
{
    private $historiqueModel;

    public function __construct()
    {
        $db = Flight::db();
        $this->historiqueModel = new Historique($db);
    }


    public function recapitulatif()
    {
        try {
            Flight::render('rapports');

        } catch (\Exception $e) {
            Flight::halt(500, 'Erreur lors du chargement du récapitulatif: ' . $e->getMessage());
        }
    }

    public function getRecapJson()
    {
        try {
            // Récupérer les totaux globaux depuis le modèle
            $recap = $this->historiqueModel->getBesoinsRestantParVille();
            
            // Calculer le taux de satisfaction
            $taux_global = $recap['montant_total'] > 0 
                ? round(($recap['montant_satisfait'] / $recap['montant_total']) * 100, 2) 
                : 0;

            // Retourner en JSON
            Flight::json([
                'success' => true,
                'data' => [
                    'totaux' => [
                        'besoins' => $recap['montant_total'],
                        'satisfait' => $recap['montant_satisfait'],
                        'restant' => $recap['montant_restant'],
                        'taux' => $taux_global
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Flight::json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
?>