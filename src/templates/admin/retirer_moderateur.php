<?php

use App\Controllers\Auth\Users\UserBD;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_user = $_POST['id_user'];
    UserBD::unSetModo($id_user);
    header('Location: index.php?action=dashboard');
}

?>

<div class="page" >
    <div class="form-container" style ="margin-top: 10rem;">
        <a href="index.php?action=dashboard"><i class='fas fa-angle-left' style='font-size:24px'></i></a>
        <h1>Retirer un Modérateur</h1>
        <form action="#" method="POST">

            <div class="input-container">
                <label for="id_user">Choisir une Personne</label>
                <select id="id_user" name="id_user" required>
                    <?php
                    $allUsers = UserBD::getAllModos();
                    foreach ($allUsers as $user) {
                        echo '<option value="' . $user['id_utilisateur'] . '">' . $user['nom'] . ' ' . $user['prenom'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Retirer le Modérateur</button>
        </form>
    </div>
</div>