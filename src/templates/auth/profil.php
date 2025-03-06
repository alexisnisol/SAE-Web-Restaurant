<div class="page">
    <div class="form-container">
        <h2>Modifier mon profil</h2>
        
        <form action="#" method="POST">
            <input type="text" name="firstName" placeholder="Prénom" value="<?=$user->firstName ?>" required>
            <input type="text" name="lastName" placeholder="Nom" value="<?=$user->lastName?>" required>
            <input type="email" name="email" placeholder="Adresse mail" value="<?=$user->email?>" required>
            <input type="password" name="password" placeholder="Mot de passe">
            
            <?php 
            if (isset($error)) {
                echo '<p class="error-message">*' . $error . '</p>';
            }
            ?>
            
            <button type="submit">Modifier</button>
        </form>

        <a href="./index.php?action=planning" class="register-link">Retour</a>
    </div>
</div>
