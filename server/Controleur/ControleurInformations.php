<?php

require_once 'Framework/Controleur.php';
require_once 'Framework/Vue.php';

class ControleurInformations extends Controleur {

    private $vue;

    public function __construct() {
        $this->vue = new Vue("index");
    }

    public function index() {
        //$this->vue->genererFichier('VueInformations/index.php', array());
        //echo file_get_contents('VueInformations/index.php');
        ob_start();
        include('VueInformations/index.php'); // Remplacez "example.php" par le nom de votre fichier PHP
        $variable = ob_get_clean();

        // Affichage de la variable avec echo
        echo $variable;
    }
}

