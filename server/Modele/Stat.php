<?php

require_once 'Framework/Modele.php';

class Stat extends Modele
{
    /**
     * get number of comment for a user
     */
    public function getNbCommentOfUser($idUser){
        $sql = "select count(*) as nb_comment from commentaire where id_user=?";
        $nb_comment = $this->executerRequete($sql, array($idUser));
        return $nb_comment->fetchAll();
    }

    /**
     * get average of vote for a bloc
     */
    public function getAverageVoteOfBloc($idBloc){
        $sql = "SELECT COUNT(v.id) AS nombre_votes, 
                SUM(c.valeur) AS somme_cotation, 
                AVG(c.valeur) AS moyenne_cotation
                FROM cotation c
                JOIN vote v ON c.id = v.id_cotation
                WHERE v.id_bloc = ?";
        $sum = $this->executerRequete($sql, array($idBloc));
        return $sum->fetchAll();
    }

    /**
     * get vote for a user
     */
    public function getAllVoteOfUser($idUser){
        $sql = "select * from vote where id_user=? order by id asc";
        $votes = $this->executerRequete($sql, array($idUser));
        return $votes->fetchAll();
    }
    
}
