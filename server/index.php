<?php

// Contrôleur frontal : instancie un routeur pour traiter la requête entrante

require 'Framework/Routeur.php';

// import de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$routeur = new Routeur();
$routeur->routerRequete();


