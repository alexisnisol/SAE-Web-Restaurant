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
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_name'] = $user->lastName;
                $_SESSION['role'] = $user->getRole();
                header('Location: /');
            }else{
                $error = 'Mot de passe incorrect';
            }
        }else{
            $error = "Nom d'utilisateur incorrect";
        }

        return $error;
    }

    static function checkRegisterForm($email, $password, $firstName, $lastName): string
    {
        $user = Auth::getUserByEmail($email);

        $error = '';
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
        $user = Auth::getCurrentUserObj();

        $error = '';
        if($user){
            $user->firstName = $firstName;
            $user->lastName = $lastName;
            $user->email = $email;
            if($password){
                $user->password = $password;
                $user->hashPassword();
            }
            $user->updateDatabase();

            //redirect to login page
            header('Location: /index.php?action=planning');
        }else{
            $error = "Utilisateur non trouvé";
        }

        return $error;
    }
}

?>