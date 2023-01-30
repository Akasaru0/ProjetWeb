<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "Framework/Configuration.php";

class Mailer{
    public static $mail;

    function __construct()
    {
        self::$mail = new PHPMailer(true);
        self::$mail->isSMTP();                                      // Set mailer to use SMTP
        self::$mail->Host = Configuration::get("host","smtp-relay.sendinblue.com");                     // Specify main and backup SMTP servers
        self::$mail->SMTPAuth = true;                               // Enable SMTP authentication
        self::$mail->Username = Configuration::get("username",'noreply.summitscore@gmail.com');   // SMTP username
        self::$mail->Password = Configuration::get("password");                           // SMTP password
        self::$mail->SMTPSecure = 'tls';   
        self::$mail->Port = 587;
        self::$mail->isHTML(true);
    }

    public static function send($from,$to,$subject,$body){
        self::$mail->From = $from;
        self::$mail->FromName = 'no-reply';
        self::$mail->addAddress($to);                 // Add a recipient

        self::$mail->WordWrap = 75;                                 // Set word wrap to 50 characters

        self::$mail->Subject = $subject;
        self::$mail->Body    = $body;

        if(!self::$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . self::$mail->ErrorInfo;
        } else {
            // echo 'Message has been sent';
        }
    }
}