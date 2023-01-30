<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/User.php';
require_once 'Framework/Mailer.php';
/**
 * Contrôleur gérant la connexion au site
 *
 * @author Baptiste Pesquet
 */
class ControleurSecurity extends Controleur
{
    private $utilisateur;
    private $mailer;

    public function __construct()
    {
        $this->utilisateur = new User();
        $this->mailer = new Mailer();
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
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                http_response_code(400);
                die("Adresse email invalide");
            }
            $mdp = $this->requete->getParametre("mdp");
            $username = $this->requete->getParametre("username");

            $token = $this->utilisateur->createUser($username, $mdp, $mail); //TODO voir si il n'est pas plus judicieux de creer a la fin 

            $to      = $mail;
            $subject = 'Vérification de mail';
            // $message = 'Bonjour vous voulez vous inscrire sur notre site veuillez cliquer sur le lien pour vous finaliser votre inscription';
            $url_validation = Configuration::get("url_validation",'http://localhost/projetWeb/ProjetWeb/server/index.php?controleur=Security&action=validation');
            $message = "<html><head>Validation du mail</head>";
            $message .= "<body>";
            $message .= "Pour activer votre compte veuillez cliquer sur le lien ci-dessous.";
            $message .= "<br>";
            $message .= '<a href="';
            $message .= $url_validation;
            $message .= "&token=";
            $message .= $token;
            $message .= '">Cliquez ici</a>';
            $message .= "<br>";
            $message .= "Si l'action n'est pas de vous, veuillez supprimer ce mail.";
            $message .= "</body></html>";
            $this->mailer->send("no-reply@web.project",$to,$subject,$message);
            echo "un email de vérification vous a été envoyé. Vérifiez vos mails.";
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

    public function validation()
    {
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            $token = $this->requete->getParametre("token");
            if($this->utilisateur->activerCompte($token)){
                echo "activation réussie";
            }else{
                echo "mauvais token d'activation";
            }
        }else{
            http_response_code(405);
            die("Requete GET uniquement pour se connecter");  
        }
    }

    public function reset()
    {
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            try {
                $mail = $this->requete->getParametre("mail");
                $user = $this->utilisateur->getUtilisateurByMail($mail);
                $token = bin2hex(random_bytes(20));
                $user_id = $user["id"];
                $this->utilisateur->setActivationToken($user_id,$token);
                $url_reset = Configuration::get("url_reset",'http://localhost/projetWeb/ProjetWeb/server/index.php?controleur=Security&action=reset');;
                $to      = $mail;
                $subject = 'Reinitialisation du mot de passe';
                $message = "<html><head>Mot de passe temporaire:</head><body>";
                $message .= '<a href="';
                $message .= $url_reset;
                $message .= "&token=";
                $message .= $token;
                $message .= '">Cliquez ici</a>';
                $message .= "</body></html>";
                $this->mailer->send("no-reply@web.project",$to,$subject,$message);

                echo "vérifiez vos mails pour réinitialiser votre mot de passe";
            }catch(Exception $e){
                http_response_code(400);
                die("Parametre 'mail' manquant ou invalide"); 
            }            
        }elseif($_SERVER['REQUEST_METHOD']==='GET')
        {
            if($this->requete->existeParametre("token")){
                $token = $this->requete->getParametre("token");
                if($this->utilisateur->existeToken($token)){
                    // TODO change password and send the new one
                    $temp_mdp = bin2hex(random_bytes(15)); //temporary password
                    $utilisateur = $this->utilisateur->getUtilisateurByToken($token);
                    if(!$utilisateur["change_password"]){
                        $user_id = $utilisateur["id"];
                        $this->utilisateur->setTemporaryPassword($user_id,$temp_mdp);
                        // send mail of the new pwd
                        $to      = $utilisateur["mail"];
                        $subject = 'Reinitialisation du mot de passe';
                        $message = "<html><head>Mot de passe temporaire:</head><body>";
                        $message .= $temp_mdp;
                        $message .= "</body></html>";
                        $this->mailer->send("no-reply@web.project",$to,$subject,$message);
                        echo "Votre mot de passe a été envoyé par mail.";
                    }else{
                        http_response_code(400);
                        die("Vous n'avez pas fait de demande de réinitialisation"); 
                    }
                }else{
                    http_response_code(400);
                    die("Parametre 'token' invalide"); 
                }
            }else{
                http_response_code(400);
                die("Parametre 'token' manquant"); 
            }
        }else{
            http_response_code(405);
            die("Requete POST / GET uniquement");  
        }
    }

    function changer_mdp(){
        if($_SERVER["REQUEST_METHOD"]==="GET"){
            try {
                $mdp = $_POST["mdp"];
                $user_id = $_POST["id"];
                $this->utilisateur->setPassword($user_id,$mdp);
                echo "Votre mot de passe a été modifié avec succès.";
            } catch (Exception $e) {
                http_response_code(400);
                die("Paramètres invalides");  
            }
        }else{
            http_response_code(405);
            die("Requete POST uniquement");  
        }
    }

}