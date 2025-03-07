<?php

use App\Controllers\Auth\Auth;
use App\Controllers\Users\User;
use App\Controllers\Auth\AuthForm;

$user = Auth::getCurrentUser();
if (!$user) {
    $error = "Utilisateur non connecté.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $error = AuthForm::checkUpdateForm($email, $password, $firstName, $lastName);

    if (!$error) {
        $success = "Profil mis à jour avec succès.";
        
    }
}
?>

<div class="page">
    <div class="form-container">
        <h2>Modifier mon profil</h2>
        
        <form action="#" method="POST">
            <input type="text" name="firstName" placeholder="Prénom" 
                   value="<?= htmlspecialchars($user->firstName ?? '') ?>" required>
            <input type="text" name="lastName" placeholder="Nom" 
                   value="<?= htmlspecialchars($user->lastName ?? '') ?>" required>
            <input type="email" name="email" placeholder="Adresse mail" 
                   value="<?= htmlspecialchars($user->email ?? '') ?>" required>
            <input type="password" name="password" placeholder="Nouveau mot de passe">
            <input type="password" name="confirmPassword" placeholder="Confirmer le mot de passe">
            
            <?php if (isset($error)): ?>
                <p class="error-message">* <?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            
            <button type="submit">Modifier</button>
        </form>

        <a href="./index.php?action=planning" class="register-link">Retour</a>
    </div>
</div>
