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
        $database->beginTransaction();
        $database->exec("DELETE FROM historique");
        $database->exec("INSERT INTO historique SELECT * FROM historique_initial");
        $database->commit();
    }
}

?>