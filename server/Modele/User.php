<?php

require_once 'Framework/Modele.php';

class User extends Modele
{
    public function createUser($username, $mdp, $mail){
        $sql = "insert into user (username, password, mail) values (?,?,?)";
        $hash_mdp = $this->getHashedPassword($mdp);
        $this->executerRequete($sql, array($username, $hash_mdp, $mail));
    }

    /**
     * Renvoie le mot de passe crypte
     * 
     * @param string $mdp e mot de passe
     * @return string le mot de passe hash
     */
    protected function getHashedPassword($mdp){
        return password_hash($mdp,PASSWORD_BCRYPT);
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     * 
     * @param string $login Le login
     * @param string $mdp Le mot de passe
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getUtilisateur($login, $mdp)
    {
        $sql = "select * from user where mail=?";
        $utilisateur = $this->executerRequete($sql, array($login));
        if ($utilisateur->rowCount() == 1){
            $user = $utilisateur->fetch();  // Accès à la première ligne de résultat
            $hashed = $user['password'];
            if (password_verify($mdp, $hashed)){
                return $user;
            }
        }        
        throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
    }

    /**
     * Vérifie qu'un utilisateur existe dans la BD
     * 
     * @param string $login Le login
     * @param string $mdp Le mot de passe
     * @return boolean Vrai si l'utilisateur existe, faux sinon
     */
    public function connecter($login, $mdp)
    {
        $sql = "select * from user where mail=?";
        $utilisateur = $this->executerRequete($sql, array($login));

        if ($utilisateur->rowCount() != 1) return false;
        else 
        {
            $utilisateur_obj = $utilisateur->fetch(PDO::FETCH_ASSOC);
            $hashed = $utilisateur_obj['password'];
            return password_verify($mdp, $hashed);
        }
    }
}