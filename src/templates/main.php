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
    <script src="./static/js/menu_profil.js"></script>
    <link rel="stylesheet" href="./static/css/header.css">
    <link rel="stylesheet" href="./static/css/footer.css">
    <?php if (!empty($cssFiles)) {
        foreach ($cssFiles as $cssFile) {
            echo '<link rel="stylesheet" href="./static/css/' . $cssFile . '">';
        }
    } ?>
    <title><?= $title ?? 'Taste&Tell' ?></title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <a href="./index.php?action=home" class="logo">
                    <img src="./static/images/logo.jpg" alt="Logo Taste&Tell">
                    <span class="title">Taste&Tell</span>
                </a>
            </div>
            <div class="nav-center">
                <ul class="nav-links">
                    <li><a href="./index.php">Découvrir</a></li>
                    <li><a href="#avis">Vos Avis</a></li>
                    <li><a href="./index.php?action=carte">Carte</a></li>
                    <li><a href="./index.php?action=a-propos">Plus</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <?php if (Auth::isUserLoggedIn()) : ?>
                    <p>Bonjour, <?= Auth::getCurrentUser()->firstName ?></p>
                    <?php if (Auth::getCurrentUser()->isAdmin()) : ?>
                        <a href="index.php?action=dashboard" class="btn-se-connecter">Dashboard</a>
                    <?php endif; ?>
                <?php else : ?>
                    <a href="./index.php?action=login" class="btn-se-connecter">Se connecter</a>
                <?php endif; ?>
                <img id="profile-icon" class="class-img-profil" src="./static/images/icon-profile.png" alt="Profil">
            </div>
        </nav>
        <div id="profile-menu" class="profile-menu">
            <div class="menu-content">
                <div id="close-menu" class="close-menu">&times;</div>
                <div class="top-menu">
                    <p>Mon Profil</p>
                    <img class="class-logo-profil" src="./static/images/icon-profile.png" alt="Profil">
                </div>
                <a href="./index.php?action=profil">Gérer mon Profil</a>
                <a href="index.php?action=logout" id="logout-btn">Déconnexion</a>
            </div>
        </div>
        <?php
            if (Auth::isUserLoggedIn()) {
                echo "<ul class=\"login\">";
                echo '<li>Bonjour, ' . Auth::getCurrentUser()->firstName . '</li>';

                if (Auth::getCurrentUser()->isAdmin()) {
                    echo '<li><a href="index.php?action=dashboard" class="btn-se-connecter">Dashboard</a></li>';
                }

                echo '<li><a href="index.php?action=logout" class="btn-se-connecter">Déconnexion</a></li>';
                echo "</ul>";
            } else {
                echo '<a href="./index.php?action=login" class="btn-se-connecter">Se connecter</></a>';
        }
        ?>
    </nav>
</header>

    <main>
        <?php Flash::flash(); ?>
        <?= $content ?? '' ?>
    </main>

    <footer>
        <div class="footer-logo">
            <img src="../static/images/logo.jpg" alt="Logo Taste&Tell">
        </div>
        <div class="footer-column">
            <h3>En savoir plus</h3>
            <ul>
                <li><a href="./index.php?action=a-propos">À propos</a></li>
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
            </div>
        </div>
    </footer>
</body>
</html>
