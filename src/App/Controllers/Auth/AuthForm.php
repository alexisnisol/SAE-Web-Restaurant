<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\Users\User;

class AuthForm {

    static function checkLoginForm($email, $password): string
    {
        $user = Auth::getUserByEmail($email);
        $error = '';
        if($user){
            if(password_verify($password, $user->password)){
                Auth::setUserSession($user);
                header('Location: /');
            }else{
                $error = 'Mot de passe incorrect';
            }
        }else{
            $error = "Nom d'utilisateur incorrect";
        }

        return $error;
    }

    static function checkRegisterForm($email, $password, $password_check, $firstName, $lastName): string
    {
        $error = '';

        if ($password !== $password_check) {
            return "Les mots de passe ne correspondent pas";
        }

        //check regex password strength :
        // + de 8 caractères
        // au moins une lettre majuscule
        // au moins une lettre minuscule
        // au moins un nombre
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
            return "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un nombre";
        }

        $user = Auth::getUserByEmail($email);
        
        if(!$user){
            $userObj = new User(null, $firstName, $lastName, $email, $password);
            $userObj->register();

            //redirect to login page
            header('Location: /index.php?action=login');
        }else{
            $error = "Un utilisateur avec cet email existe déjà";
        }

        return $error;
    }

    static function checkUpdateForm($email, $password, $firstName, $lastName): string
    {
        $user = Auth::getCurrentUser();

        $error = '';
        if ($user) {
            $user->firstName = $firstName;
            $user->lastName = $lastName;
            $user->email = $email;
            if ($password) {
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
                    return "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un nombre";
                }
                $user->password = $password;
                $user->hashPassword();
            }
            print_r($user);
            $user->updateDatabase();

            //redirect to login page
            header('Location: /index.php');
        } else {
            $error = "Utilisateur non trouvé";
        }
        return $error;
    }
}

?>