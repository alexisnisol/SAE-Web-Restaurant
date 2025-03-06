<?php
use App\Controllers\Auth\Users\User;
use App\Controllers\Auth\Auth;
use App\Controllers\Auth\Users\Role;


$user = Auth::getCurrentUser();
?>


<div class="page">
    <div class="form-container">
        <h1 style="margin-bottom:1rem">Dashboard - Modérateur</h1>
        <button onclick="window.location='index.php?action=avisModo';">Voir Tous les Avis</button>
        <?php if ($user->role === Role::ADMIN) : ?>
            <button onclick="window.location='index.php?action=ajouter_Modo';">Ajouter un Modérateur</button>
            <button onclick="window.location='index.php?action=retirer_Modo';">Retirer un Modérateur</button>
        <?php endif; ?>

</div>