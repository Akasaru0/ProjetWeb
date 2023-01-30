<?php

require_once 'Framework/Modele.php';

class User extends Modele
{
    public function createUser($username, $mdp, $mail){
        $activation_token = bin2hex(random_bytes(20));
        $sql = "insert into user (username, password, mail, activation_token) values (?,?,?,?)";
        $hash_mdp = $this->getHashedPassword($mdp);
        $this->executerRequete($sql, array($username, $hash_mdp, $mail,$activation_token));
        return $activation_token;
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
     * @param string $mail Le mail
     * @param string $mdp Le mot de passe
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getUtilisateur($mail, $mdp)
    {
        $sql = "select * from user where mail=?";
        $utilisateur = $this->executerRequete($sql, array($mail));
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
     * Renvoie un utilisateur existant dans la BD
     * 
     * @param string $mail le mail
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getUtilisateurByMail($mail)
    {
        $sql = "select * from user where mail=?";
        $utilisateur = $this->executerRequete($sql, array($mail));
        if ($utilisateur->rowCount() == 1){
            $user = $utilisateur->fetch();  // Accès à la première ligne de résultat
            return $user;
        }        
        throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     * 
     * @param string $token le token
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getUtilisateurByToken($token)
    {
        $sql = "select * from user where activation_token=?";
        $utilisateur = $this->executerRequete($sql, array($token));
        if ($utilisateur->rowCount() == 1){
            return $utilisateur->fetch();  // Accès à la première ligne de résultat
        }        
        throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     * 
     * @param string $token le token
     * @return mixed L'utilisateur
     * @throws Exception Si aucun utilisateur ne correspond aux paramètres
     */
    public function getUtilisateurById($id)
    {
        $sql = "select * from user where id=?";
        $utilisateur = $this->executerRequete($sql, array($id));
        if ($utilisateur->rowCount() == 1){
            return $utilisateur->fetch();  // Accès à la première ligne de résultat
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

    public function activerCompte($token){
        $sql = "select * from user where activation_token=?";
        $utilisateur = $this->executerRequete($sql, array($token));

        if ($utilisateur->rowCount() != 1) return false;
        else{
            $sql = "update user set activated=1 where activation_token=?";
            $this->executerRequete($sql, array($token));
            return true;
        }
    }

    public function setActivationToken($id, $token){
        $sql = "update user set activation_token=? where id=?";
        $this->executerRequete($sql, array($token,$id));
    }

    public function existeToken($token){
        $sql = "select * from user where activation_token=?";
        $utilisateur = $this->executerRequete($sql, array($token));
        if ($utilisateur->rowCount() != 1) return false;
        else return true;
    }

    public function setTemporaryPassword($user_id,$temp_mdp){
        $sql = "update user set password=?, change_password=1 where id=?";
        $hash = $this->getHashedPassword($temp_mdp);
        $this->executerRequete($sql, array($hash,$user_id));
    }

    public function setPassword($user_id,$mdp){
        $sql = "update user set password=?, change_password=0 where id=?";
        $hash_mdp = $this->getHashedPassword($mdp);
        $this->executerRequete($sql, array($hash_mdp, $user_id));
    }
}
