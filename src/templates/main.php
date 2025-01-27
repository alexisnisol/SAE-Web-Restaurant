<?php

use App\Controllers\Auth\Auth;
use App\Views\Flash;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ce811b00f8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./static/css/header.css">
    <link rel="stylesheet" href="./static/css/footer.css">
    <?php
    if (!empty($cssFiles)) {
        foreach ($cssFiles as $cssFile) {
            echo '<link rel="stylesheet" href="./static/css/' . $cssFile . '">';
        }
    }
    ?>
    <title><?php echo $title ?? null ?></title>
</head>
<body>

<header>
        <nav class="navbar">
            <div class="logo">
                <img src="../static/images/logo.jpg" alt="Logo Taste&Tell">
                <span>Taste&Tell</span>
            </div>
            <ul class="nav-links">
                <li><a href="#decouvrir">Découvrir</a></li>
                <li><a href="#avis">Avis</a></li>
                <li><a href="#plus">Plus</a></li>
            </ul>
            <button class="btn-se-connecter">Se connecter</button>
        </nav>
    </header>

<main>
    <?php Flash::flash();?>
    <?php echo $content ?? null ?>
</main>

<footer>
        <div class="footer-logo">
            <img src="../static/images/logo.jpg" alt="Logo Taste&Tell">
        </div>
        <div class="footer-column">
            <h3>En savoir plus</h3>
            <ul>
                <li><a href="#apropos">À propos</a></li>
                <li><a href="#sinscrire">S'inscrire</a></li>
                <li><a href="#restaurants">Restaurants à proximité</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Mentions légales</h3>
            <ul>
                <li><a href="#conditions">Conditions d'utilisation</a></li>
                <li><a href="#confidentialite">Politique de confidentialité</a></li>
                <li><a href="#cookies">Utilisation des cookies</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Contacts</h3>
            <ul>
                <li>Tel : 02.38.45.69.25</li>
                <li>Nos réseaux</li>
            </ul>
            <div class="social-icons">
                <span class="circle">
                    <img src="instagram-icon.png" alt="Instagram">
                </span>
                <span class="circle">
                    <img src="tiktok-icon.png" alt="TikTok">
                </span>
                <span class="circle">
                    <img src="facebook-icon.png" alt="Facebook">
                </span>
            </div>
        </div>
        <div class="footer-bottom">
        © 2025 Taste&Tell - Tous droits réservés.
        </div>
    </footer>
</body>
</html>