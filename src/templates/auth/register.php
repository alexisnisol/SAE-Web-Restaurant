<?php

use App\Controllers\Auth\AuthForm;

//if is post request
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //get post data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $error = AuthForm::checkRegisterForm($email, $password, $password_check, $firstName, $lastName);
}

?>

<div class="page">
    <div class="form-container">
        <h2>S'inscrire maintenant</h2>
        
        <form action="#" method="post">
            <div class="input-row">
                <div class="input-container">
                    <input type="text" placeholder="Prénom" name="firstName" required>
                </div>
                <div class="input-container">
                    <input type="text" placeholder="Nom" name="lastName" required>
                </div>
            </div>
            
            <div class="input-container">
                <input type="email" placeholder="Adresse mail" name="email" required>
            </div>

            <div class="input-container">
                <input type="password" placeholder="Mot de passe" name="password" required>
            </div>


            <div class="input-container">
                <input type="password" placeholder="Mot de passe" name="password_check" required>
            </div>

            <?php 
            if (isset($error)) {
                echo '<p class="error-message">*' . $error . '</p>';
            }
            ?>
            <button type="submit">S'inscrire</button>
        </form>

        <a href="./index.php?action=login" class="register-link">Déjà un compte ? Connectez-vous</a>
    </div>
</div>