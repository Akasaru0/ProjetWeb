<?php
require_once 'Framework/Controleur.php';

class ControleurCommentaire extends Controleur {
    private $commentaire;
    // Affiche la liste de tous les billets du blog
    public function index() {
        
    }
    public function __construct()
    {
        $this->commentaire = new Commentaire();
    }
    public function creer(){
        if( $_SERVER['REQUEST_METHOD'] === "POST")
        {
            $id_user = $_GET['id_comment'];
            $date_creation = date('H:i:s d-m-Y');
            $id_bloc = $_GET['id_bloc'];
            $libelle = $_GET["libelle"];
            $this->commentaire->createCommentaire($id_user,$date_creation,$id_bloc,$libelle);
        }
    }

}