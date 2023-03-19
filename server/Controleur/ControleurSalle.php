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
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            if($this->utilisateur->isGranted($user_id,"EDITOR")){
                $parametres = array("nom","adresse","image");
                if($this->requete->existeParametres($parametres)){
                    $nom = $this->requete->getParametre("nom");
                    $adresse = $this->requete->getParametre("adresse");
                    $image = $this->requete->getParametre("image");
                    $this->salle->createSalle($nom,$adresse,$image);
                    echo "La salle a été créée";
                }else{
                    http_response_code(400);
                    die("parametres manquants");  
                }
                //TODO
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
        if($this->requete->getSession()->existeAttribut("mail")){
            $user_id = $this->requete->getSession()->getAttribut("id_user");
            if($this->utilisateur->isGranted($user_id,"EDITOR")){
                $parametres = array("nom","adresse","image","id_salle");
                if($this->requete->existeParametres($parametres)){
                    $idSalle = $this->requete->getParametre("id_salle");
                    $nom = $this->requete->getParametre("nom");
                    $adresse = $this->requete->getParametre("adresse");
                    $image = $this->requete->getParametre("image");
                    $this->salle->editSalle($nom,$adresse,$image,$idSalle);
                    echo "La salle a été modifié";
                }else{
                    http_response_code(400);
                    die("parametres manquants");  
                }
                //TODO
            }else{
                http_response_code(403);
                die("vous n'avez pas les droits pour faire cette action");  
            }
            
        }else{
            http_response_code(403);
            die("vous devez être connecté pour continuer");  
        }
    }

}