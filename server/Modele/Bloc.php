<?php

require_once 'Framework/Modele.php';

class Bloc extends Modele
{
    public function createBloc($description, $id_couleur, $id_salle){
        $sql = "INSERT INTO `bloc`(`description`, `id_couleur`, `id_salle`) VALUES (?,?,?)"
        //$sql = "insert into bloc (username, password, mail, activation_token) values (?,?,?,?)";
        $this->executerRequete($sql, array($description, $id_couleur, $id_salle));
        return $activation_token;
    }
}
