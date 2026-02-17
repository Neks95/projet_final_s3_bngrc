<?php
namespace app\controllers;

use Flight;
use app\models\Dispatch;

class DispatchController {

    private $model;

    public function __construct() {
        $this->model = new Dispatch();
    }

    /**
     * Lance la simulation selon le mode choisi et retourne les résultats en JSON
     */
    public function simulateDispatch() {
        // Nettoyer tout output buffer existant pour éviter le HTML parasite
        while (ob_get_level()) {
            ob_end_clean();
        }

        $mode = Flight::request()->query->mode ?? 'date';
        $frais = (float)(Flight::request()->query->frais ?? 0.0);

        switch ($mode) {
            case 'plusPetit':
                $simulationResult = $this->model->simulateDispatchPlusPetit($frais);
                break;
            case 'proportion':
                $simulationResult = $this->model->simulateDispatchProportionnel($frais);
                break;
            case 'date':
            default:
                $simulationResult = $this->model->simulateDispatchParVille($frais);
                break;
        }

        $response = [
            'success'      => true,
            'mode'         => $mode,
            'dispatch'     => $simulationResult['dispatch'] ?? [],
            'donsRestants' => $simulationResult['donsRestants'] ?? [],
        ];

        // Envoyer manuellement le JSON et arrêter
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
        exit; // Arrêt complet — rien d'autre ne sera envoyé
    }

    /**
     * Valide et enregistre les résultats de la simulation en base de données
     */
    public function validateDispatch() {
        // Nettoyer tout output buffer existant
        while (ob_get_level()) {
            ob_end_clean();
        }

        $mode = Flight::request()->data->mode ?? 'date';
        $frais = (float)(Flight::request()->data->frais ?? 0.0);

        switch ($mode) {
            case 'plusPetit':
                $simulationResult = $this->model->simulateDispatchPlusPetit($frais);
                break;
            case 'proportion':
                $simulationResult = $this->model->simulateDispatchProportionnel($frais);
                break;
            case 'date':
            default:
                $simulationResult = $this->model->simulateDispatchParVille($frais);
                break;
        }

        $dispatchList = $simulationResult['dispatch'] ?? [];
        $count = 0;

        foreach ($dispatchList as $d) {
            if (isset($d['attribue']) && $d['attribue'] > 0 && !empty($d['don_id'])) {
                $this->model->saveAttribution(
                    $d['don_id'],
                    $d['id_besoin'],
                    $d['attribue'],
                    date('Y-m-d H:i:s')
                );
                $count++;
            }
        }

        $response = [
            'success' => true,
            'message' => $count . " attributions validées et enregistrées dans l'historique."
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }
}