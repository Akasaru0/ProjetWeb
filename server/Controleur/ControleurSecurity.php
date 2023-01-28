<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/User.php';

/**
 * Contrôleur gérant la connexion au site
 *
 * @author Baptiste Pesquet
 */
class ControleurSecurity extends Controleur
{
    private $utilisateur;

    public function __construct()
    {
        $this->utilisateur = new User();
    }

    public function index()
    {
        // $this->genererVue();
    }

    /**
     * Fonction d'inscription d'un utilisateur
     */
    public function inscription()
    {
        if ($_SERVER['REQUEST_METHOD']==='POST')
        {
            $mail = $this->requete->getParametre("mail");
            $mdp = $this->requete->getParametre("mdp");
            $username = $this->requete->getParametre("username");

            $this->utilisateur->createUser($username, $mdp, $mail);
            // $this->rediriger("accueil");
        }
        else
        {
            http_response_code(405);
            throw new Exception("Requete POST uniquement pour s'inscrire");
        }
    }

    public function connecter()
    {
        header('Access-Control-Allow-Origin: *');
        if ($_SERVER['REQUEST_METHOD']==='POST'){

            $login = $_POST["mail"];
            $mdp = $_POST["mdp"];
            if ($this->utilisateur->connecter($login, $mdp)) 
            {
                $utilisateur = $this->utilisateur->getUtilisateur($login, $mdp);
                $this->requete->getSession()->setAttribut("id",
                        $utilisateur['id']);
                $this->requete->getSession()->setAttribut("mail",
                        $utilisateur['mail']);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($utilisateur);
            }
            else
            {
                http_response_code(401);
                die("Login ou mot de passe incorrects");
            }

        }else
        {         
            http_response_code(405);
            die("Requete POST uniquement pour se connecter");
        }
    }

    public function deconnecter()
    {
        $this->requete->getSession()->detruire();
        // $this->rediriger("accueil");
    }

}