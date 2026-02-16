<?php
namespace app\controllers;

use Flight;
use app\models\dispatch;

class DispatchController {

    private $model;

    public function __construct() {
        $this->model = new Dispatch();
    }

    public function simulateDispatch($frais = 0) {
        $result = [];

        $besoins = $this->model->getBesoins();
        $dons = $this->model->getDons();

        foreach ($besoins as $b) {
            $besoinRestant = $b['qte_besoin_ville'];

            foreach ($dons as &$d) {
                if ($d['id_type'] != $b['id_type']) continue;
                if ($d['qte'] <= 0) continue;

                $attribue = min($besoinRestant, $d['qte']);
                $montant = $attribue * $b['prix_unitaire'] * (1 + $frais / 100);

                $result[] = [
                    'id_besoin' => $b['id_besoin'],
                    'ville' => $b['ville'],
                    'type' => $b['nom_type'],
                    'attribue' => $attribue,
                    'montant' => $montant,
                    'don_id' => $d['id_don']
                ];

                $d['qte'] -= $attribue;
                $besoinRestant -= $attribue;

                if ($besoinRestant <= 0) break;
            }
        }

        return $result;
    }

    public function validateDispatch($frais = 0) {
        $dispatch = $this->simulateDispatch($frais);

        foreach ($dispatch as $d) {
            $this->model->saveAttribution($d['don_id'], $d['id_besoin'], $d['attribue']);
        }

        return count($dispatch) . " attributions validées";
    }
}
