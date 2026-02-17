<?php
namespace app\controllers;

use Flight;
use app\models\Dispatch;

class DispatchController {

    private $model;

    public function __construct() {
        $this->model = new Dispatch();
    }

    
    public function simulateDispatch($frais = 0.0) {
        $simulationResult = $this->model->simulateDispatchParVille((float)$frais);
        
   
        return $simulationResult['dispatch'] ?? [];
    }

   
    public function validateDispatch($frais = 0.0) {

        $dispatchList = $this->simulateDispatch($frais);
        
        $count = 0;
        
        foreach ($dispatchList as $d) {
            if (isset($d['attribue']) && $d['attribue'] > 0) {
                
                
                $this->model->saveAttribution(
                    $d['don_id'], 
                    $d['id_besoin'], 
                    $d['attribue'],
                    date('Y-m-d H:i:s')
                );
                
                $count++;
            }
        }

        return $count . " attributions validées et enregistrées dans l'historique.";
    }
}