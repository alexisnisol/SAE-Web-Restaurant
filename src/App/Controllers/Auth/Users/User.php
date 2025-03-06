<?php

namespace App\Controllers\Auth\Users;

use App;
use App\Controllers\Auth\Auth;

class User {
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public Role $role;

    public function __construct($id, $firstName, $lastName, $email, $password, $role='CLIENT'){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->role = Role::valueOf($role);
        
    }

    public function getRole(): Role {
        return $this->role;
    }

    public function isAdmin(): bool {
        return $this->role === Role::ADMIN;
    }

    public function isClient(): bool {
        return $this->role === Role::CLIENT;
    }

    public function isModerator(): bool {
        return $this->role === Role::MODERATOR;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function register(){
        $this->hashPassword();
        $query = App::getApp()->getDB()->prepare('INSERT INTO UTILISATEUR (id_utilisateur, nom, prenom, email, mdp) VALUES (:id, :nom, :prenom, :email, :mdp)');
        $query->execute(array(':id' => Auth::getNextUserId(), ':nom' => $this->lastName, ':prenom' => $this->firstName, ':email' => $this->email, ':mdp' => $this->password));
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