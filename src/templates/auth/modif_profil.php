<?php

use App\Controllers\Auth\AuthForm;
use App\Controllers\Auth\Auth;

//if is post request
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //get post data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $error = AuthForm::checkUpdateForm($email, $password, $firstName, $lastName);
}

$user=Auth::getCurrentUser();

?>

<div class="page">
    <div class="form-container">
        <h2>Modifier mon profil</h2>
        
        <form action="#" method="post">
            <div class="input-row">
                <div class="input-container">
                    <input type="text" placeholder="Prénom" name="firstName" value="<?=$user->firstName ?>" required>
                </div>
                <div class="input-container">
                    <input type="text" placeholder="Nom" name="lastName" value="<?=$user->lastName?>" required>
                </div>
            </div>

            <div class="input-container">
                <input type="email" placeholder="Adresse mail" name="email" value="<?=$user->email?>" required>
            </div>

            <div class="input-container">
                <input type="password" placeholder="Mot de passe" name="password">
            </div>

            <?php 
            if (isset($error)) {
                echo '<p class="error-message">*' . $error . '</p>';
            }
            ?>
            <button type="submit">Modifier</button>
        </form>

        <a href="./index.php?action=planning" class="register-link" style="color : red;">Retour</a>
    </div>
</div>