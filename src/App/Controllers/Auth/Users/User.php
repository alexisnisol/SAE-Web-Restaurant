<?php

namespace App\Controllers\Auth\Users;

use App;


enum Role {
    case CLIENT;
    case MODERATOR;
    case ADMIN;
}

class User {

    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public Role $role;

    public function __construct($id, $firstName, $lastName, $email, $password, $role='CLIENT'){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getRole(): Role {
        return $this->role;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function register(){
        $this->hashPassword();
        $query = App::getApp()->getDB()->prepare('INSERT INTO UTILISATEUR (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)');
        $query->execute(array(':nom' => $this->lastName, ':prenom' => $this->firstName, ':email' => $this->email, ':mdp' => $this->password));
    }

    public function updateDatabase() {
        $query = App::getApp()->getDB()->prepare(
            'UPDATE UTILISATEUR 
            SET nom = :nom, 
                prenom = :prenom,
                email = :email, 
                mdp = :mdp, 
            WHERE id_utilisateur = :id_utilisateur'
        );
    
        $query->execute(array(
            ':nom' => $this->lastName,
            ':prenom' => $this->firstName,
            ':email' => $this->email,
            ':mdp' => $this->password,
            ':id_utilisateur' => $this->id
        ));
    }
}

?>