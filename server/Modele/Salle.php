<?php

require_once 'Framework/Modele.php';

class Salle extends Modele
{
    public function getSalle($idSalle){
        $sql = "select * from salle where id=?";
        $salle = $this->executerRequete($sql, array($idSalle));
        if ($salle->rowCount() == 1){
            return $salle->fetch();
        }  
        throw new Exception("Aucune salle ne correspond aux identifiants fournis");
    }

    public function getAllSalle(){
        $sql = "select * from salle";
        $salles = $this->executerRequete($sql);
        return $salles->fetchAll();
    }

    /**
     * get all activated bloc from salle
     */
    public function getBlocsSalle($idSalle){
        $sql = "select * from bloc where id_salle=? and etat=1";
        $blocs = $this->executerRequete($sql, array($idSalle));
        return $blocs->fetchAll();
    }
}
