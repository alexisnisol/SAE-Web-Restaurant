<?php

namespace App\Controllers\Auth\Users;
use App;


class UserBD{

    static function getAllUsers(){
        $query = App::getApp()->getDB()->prepare('SELECT * FROM UTILISATEUR Where ROLE = "CLIENT"');
        $query->execute();
        return $query->fetchAll();
    }

    static function getAllModos(){
        $query = App::getApp()->getDB()->prepare("SELECT * FROM UTILISATEUR where ROLE = 'MODERATEUR'");
        $query->execute();
        return $query->fetchAll();
    }

    static function setModo($id){
        $query = App::getApp()->getDB()->prepare("UPDATE UTILISATEUR SET ROLE = 'MODERATEUR' WHERE id_utilisateur = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }

    static function unSetModo($id){
        $query = App::getApp()->getDB()->prepare('UPDATE UTILISATEUR SET ROLE = "CLIENT" WHERE id_utilisateur = :id');
        $query->bindParam(':id', $id);
        $query->execute();
    }

}

?>