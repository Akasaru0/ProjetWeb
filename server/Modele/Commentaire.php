<?php

require_once 'Framework/Modele.php';

class Commentaire extends Modele
{
    public function createCommentaire($id_user, $date_creation, $id_bloc,$libelle){
        $sql = "INSERT INTO `commentaire`(`id_user`, `date_creation`, `id_bloc`, `libelle`) VALUES ('?','?','?','?')";
        //$sql = "insert into bloc (username, password, mail, activation_token) values (?,?,?,?)";
        $this->executerRequete($sql, array($id_user, $date_creation, $id_bloc,$libelle));
    }
    public function getCommentaire($id_commentaire){
        $sql = "SELECT * FROM `bloc` WHERE id=?";
        $resultat = $this->executerRequete($sql, array($id_commentaire));
        return $resultat->fetchAll();
    }
}
