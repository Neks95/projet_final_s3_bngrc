<?php

namespace app\models;

class EtatDbservice{
    private $bd;

    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function rollback(){

        $database = $this->bd;

        $database->exec("SET FOREIGN_KEY_CHECKS = 0");

        $database->exec("TRUNCATE TABLE historique");
        $database->exec("TRUNCATE TABLE don");
        $database->exec("TRUNCATE TABLE besoin");
        $database->exec("TRUNCATE TABLE ville");
        $database->exec("TRUNCATE TABLE type_besoin");
        $database->exec("TRUNCATE TABLE categorie");

        $database->exec("INSERT INTO categorie SELECT * FROM categorie_initial");
        $database->exec("INSERT INTO type_besoin SELECT * FROM type_besoin_initial");
        $database->exec("INSERT INTO ville SELECT * FROM ville_initial");
        $database->exec("INSERT INTO besoin SELECT * FROM besoin_initial");
        $database->exec("INSERT INTO don SELECT * FROM don_initial");
        $database->exec("INSERT INTO historique SELECT * FROM historique_initial");

        $database->exec("SET FOREIGN_KEY_CHECKS = 1");
    }
}
