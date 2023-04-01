<?php

require_once 'Framework/Controleur.php';
require_once 'Modele/User.php';
require_once 'Modele/Salle.php';
require_once 'Modele/Bloc.php';

class ControleurPanel extends Controleur {

    private $user;
    private $salle;
    private $bloc;

    public function __construct() {
        $this->user = new User();
        $this->salle = new Salle();
        $this->bloc = new Bloc();
    }


    // Affiche la liste de tous les utilisateurs
    public function index() {
        $utilisateurs = $this->user->getAllUsers();
        $this->genererVue(array('utilisateurs' => $utilisateurs));
    }

    // Modifie le rôle d'un utilisateur
    public function modifierRole() {
        $idUtilisateur = $this->requete->getParametre('id');
        $role = $this->requete->getParametre('role');

        $this->user->editRole($idUtilisateur, $role);
        $this->rediriger('panel');
    }

    // Ajoute une salle
    public function ajouterSalle() {
        $nom = $this->requete->getParametre('nom');
        $adresse = $this->requete->getParametre('adresse');
        $image = $this->requete->getParametre('image');

        $this->salle->createSalle($nom, $adresse, $image);
        $this->rediriger('panel');
    }

    // Ajoute un bloc
    public function ajouterBloc() {
        $description = $this->requete->getParametre('description');
        $idCouleur = $this->requete->getParametre('idCouleur');
        $idSalle = $this->requete->getParametre('idSalle');

        $this->bloc->createBloc($description, $idCouleur, $idSalle);
        $this->rediriger('panel');
    }
}
