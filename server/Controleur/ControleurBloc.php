<?php
require_once 'Framework/Controleur.php';
require 'Modele/Bloc.php';

class ControleurBloc extends Controleur {
    private $bloc;
    // Affiche la liste de tous les billets du blog
    public function index() {
       
        
    }
    public function __construct()
    {
        $this->bloc = new Bloc();
    }

    public function creer(){
       if( $_SERVER['REQUEST_METHOD'] === "POST")
       {
        $description = $_POST['description'];
        $id_couleur = $_POST['couleur'];
        $id_salle = $_POST['salle'];
        $this->bloc->createBloc($description, $id_couleur, $id_salle);
       }
    
    }
    public function info(){
        if( $_SERVER['REQUEST_METHOD'] === "GET")
        {
        $id_bloc = $_GET['id'];
        $this->bloc->getBloc($id_bloc);
        return $this->bloc->getBloc($id_bloc);
        //verifier la requete
        //créer un bloc (SQL)
        }
        
        
    }

}