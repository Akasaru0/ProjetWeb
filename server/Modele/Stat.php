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
     * get average of vote for a user
     */
    public function getAverageVoteOfUser($idUser){
        $sql = "SELECT COUNT(v.id) AS nombre_votes, 
                SUM(c.valeur) AS somme_cotation, 
                AVG(c.valeur) AS moyenne_cotation
                FROM cotation c
                JOIN vote v ON c.id = v.id_cotation
                WHERE v.id_user = ?";
        $sum = $this->executerRequete($sql, array($idUser));
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

    /**
     * get last vote for a user
     */
    public function getLastVoteOfUser($idUser){
        $sql = "SELECT v.id, c.libelle AS couleur, s.nom AS salle, b.description, co.valeur 
                FROM vote v INNER JOIN bloc b ON v.id_bloc = b.id 
                INNER JOIN couleur c ON b.id_couleur = c.id 
                INNER JOIN salle s ON b.id_salle = s.id 
                INNER JOIN cotation co ON v.id_cotation = co.id 
                WHERE v.id_user = ? 
                ORDER BY v.id DESC 
                LIMIT 1";
        $vote = $this->executerRequete($sql, array($idUser));
        return $vote->fetchAll();
    }

    /**
     * get comment for a user
     */
    public function getAllCommentOfUser($idUser){
        $sql = "select * from commentaire where id_user=? order by id asc";
        $votes = $this->executerRequete($sql, array($idUser));
        return $votes->fetchAll();
    }

    /**
     * get vote for a user for chart
     */
    public function getAllVoteOfUserForChart($idUser){
        $sql = "SELECT v.id, c.valeur AS valeur, b.description
                FROM vote v 
                INNER JOIN bloc b ON v.id_bloc = b.id 
                INNER JOIN couleur c ON b.id_couleur = c.id 
                WHERE v.id_user = ?
                ORDER BY v.id ASC";
        $votes = $this->executerRequete($sql, array($idUser));
        return $votes->fetchAll();
    }
    
}
