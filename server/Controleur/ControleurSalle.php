<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/Salle.php';
require_once 'Modele/User.php';


class ControleurSalle extends Controleur {
    // Affiche la liste de toutes les salles du site
    private $salle;
    private $utilisateur;

    public function __construct()
    {
        $this->salle = new Salle();
        $this->utilisateur = new User();
    }

    public function index() {
        header('Access-Control-Allow-Origin: *');
        if($this->requete->getSession()->existeAttribut("mail")){
            $salles = $this->salle->getAllSalle();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($salles);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    public function getSalle(){
        header('Access-Control-Allow-Origin: *');
        if($this->requete->getSession()->existeAttribut("mail")){
            $idSalle = $this->requete->getParametre("id");
            $salle = $this->salle->getSalle($idSalle);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($salle);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }
    /**
     * retourne les blocs de la salle associe
     */
    public function getBlocsSalle(){
        header('Access-Control-Allow-Origin: *');
        if($this->requete->getSession()->existeAttribut("mail")){
            $idSalle = $this->requete->getParametre("id");
            $blocs = $this->salle->getBlocsSalle($idSalle);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($blocs);
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    /**
     * is_granted : ADMIN
     */
    public function new(){
        header('Access-Control-Allow-Origin: *');
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            if($this->utilisateur->isGranted($user_id,"ADMIN")){
                echo "ok";
            }else{
                http_response_code(403);
                die("vous n'avez pas les droits pour faire cette action");  
            }
            
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

    public function edit(){

    }

}