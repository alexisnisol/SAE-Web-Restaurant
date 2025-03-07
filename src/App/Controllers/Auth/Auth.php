<?php

namespace App\Controllers\Auth;

use App;
use App\Controllers\Auth\Users\User;

class Auth
{

    public static function setUserSession(User $user): void
    {
        $_SESSION['user'] = serialize($user);
    }

    static function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    static function getCurrentUser(): ?User
    {
        if (self::isUserLoggedIn()) {
            return unserialize($_SESSION['user']);
        }
        return null;
    }
    static function checkUserAdmin() {
        if(!self::isUserLoggedIn() || !self::getCurrentUser()->isAdmin()){
            header('Location: /index.php');
        }
    }

    static function update() {
        if (self::isUserLoggedIn()) {
            self::setUserSession(self::getUserById($_SESSION['user']->id));
        }
        return null;
    }

    static function checkUserLoggedIn() {
        if(!self::isUserLoggedIn()){
            header('Location: /index.php');
        }
    }

    static function getNextUserId() {
        $query = App::getApp()->getDB()->query('SELECT MAX(id_utilisateur) as max_id FROM UTILISATEUR');
        $result = $query->fetch();
        return $result['max_id'] + 1;
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