<?php
namespace app\controllers;

use Flight;
use app\models\Dispatch; // Attention à la majuscule selon votre fichier

class DispatchController {

    private $model;

    public function __construct() {
        $this->model = new Dispatch();
    }

    /**
     * Lance la simulation et retourne les résultats pour affichage
     */
    public function simulateDispatch($frais = 0.0) {
        // On appelle la logique complexe qui est maintenant dans le modèle
        $simulationResult = $this->model->simulateDispatchParVille((float)$frais);
        
        // On retourne uniquement la liste 'dispatch' car c'est ce que la vue attend
        // Si la vue a besoin des infos de debug, retournez tout $simulationResult
        return $simulationResult['dispatch'] ?? [];
    }

    /**
     * Valide et enregistre les résultats de la simulation en base de données
     */
    public function validateDispatch($frais = 0.0) {
        // 1. On relance la simulation pour être sûr d'avoir les données à jour
        // (au cas où le stock a changé entre l'affichage et le clic sur Valider)
        $dispatchList = $this->simulateDispatch($frais);
        
        $count = 0;
        
        // 2. On parcourt les résultats pour les insérer dans l'historique
        foreach ($dispatchList as $d) {
            // On ne sauvegarde que si une quantité a été attribuée
            if (isset($d['attribue']) && $d['attribue'] > 0) {
                
                // Appel à une méthode du modèle pour l'insertion SQL
                // (Assurez-vous d'avoir créé cette méthode dans le modèle, voir ci-dessous)
                $this->model->saveAttribution(
                    $d['don_id'], 
                    $d['id_besoin'], 
                    $d['attribue'],
                    date('Y-m-d H:i:s') // Date du mouvement
                );
                
                $count++;
            }
        }

        return $count . " attributions validées et enregistrées dans l'historique.";
    }
}