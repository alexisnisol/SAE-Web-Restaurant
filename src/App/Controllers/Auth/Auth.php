<?php

namespace App\Controllers\Auth;

use App;
use App\Controllers\Auth\Users\User;

class Auth
{

    static function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    static function getCurrentUser(): ?array
    {
        if (self::isUserLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email']
            ];
        }
        return null;
    }

    static function getCurrentUserObj() {
        if (self::isUserLoggedIn()) {
            return self::getUserById($_SESSION['user_id']);
        }
        return null;
    }

    static function checkUserLoggedIn() {
        if(!self::isUserLoggedIn()){
            header('Location: /index.php');
        }
    }

    static function getUserById($id) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM UTILISATEUR WHERE id_utilisateur = :id_p');
        $query->execute(array(':id_p' => $id));
        $user = $query->fetch();
        return self::createUserObject($user);
    }

    static function getUserByEmail($email) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM UTILISATEUR WHERE email = :email');
        $query->execute(array(':email' => $email));
        $user = $query->fetch();
        return self::createUserObject($user);
    }

    private static function createUserObject($user)
    {
        $userObj = null;
        if ($user) {
                $userObj = new User($user['id_utilisateur'], $user['nom'], $user['prenom'], $user['email'], $user['mdp'], $user['role']);
        }
        return $userObj;
    }

}
?>