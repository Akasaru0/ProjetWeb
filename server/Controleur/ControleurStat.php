<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Stat.php';


class ControleurStat extends Controleur {
    private $stat;

    public function __construct()
    {
        $this->stat = new Stat();
    }

    public function index() {
        
    }

    /**
     * retourne le nombre de commentaire d'un utilisateur
     */
    public function getNbCommentOfUser(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            $nb_comment = $this->stat->getNbCommentOfUser($user_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($nb_comment);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * retourne la moyenne des votes d'un bloc
     */
    public function getAverageVoteOfBloc(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $idBloc = $this->requete->getParametre("id");
            $average = $this->stat->getAverageVoteOfBloc($idBloc);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($average);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * retourne la moyenne des votes d'un utilisateur
     */
    public function getAverageVoteOfUser(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            $average = $this->stat->getAverageVoteOfUser($user_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($average);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * retourne tous les votes d'un utilisateur
     */
    public function getAllVoteOfUser(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            $votes = $this->stat->getAllVoteOfUser($user_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($votes);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * retourne le dernier vote d'un utilisateur
     */
    public function getLastVoteOfUser(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            $vote = $this->stat->getLastVoteOfUser($user_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($vote);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * retourne tous les commentaires d'un utilisateur
     */
    public function getAllCommentOfUser(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            $comments = $this->stat->getAllCommentOfUser($user_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($comments);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * retourne tous les votes d'un utilisateur pour le graphique
     */
    public function getAllVoteOfUserForChart(){
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            $votes = $this->stat->getAllVoteOfUserForChart($user_id);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($votes);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");
        }
    }

}