<?php

require_once 'Framework/Modele.php';

class Commentaire extends Modele
{
    public function createCommentaire($description, $id_couleur, $id_salle){
        $sql = "INSERT INTO `bloc`(`description`, `id_couleur`, `id_salle`) VALUES (?,?,?)";
        //$sql = "insert into bloc (username, password, mail, activation_token) values (?,?,?,?)";
        $this->executerRequete($sql, array($description, $id_couleur, $id_salle));
    }
    public function getBloc($id_bloc){
        $sql = "SELECT * FROM `bloc` WHERE id=?";
        $resultat = $this->executerRequete($sql, array($id_bloc));
        return $resultat->fetchAll();
    }
}
