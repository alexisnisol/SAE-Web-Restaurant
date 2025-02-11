<?php

use App\Controllers\Carousel\RestauCarousel;

$query = App::getApp()->getDB()->prepare('SELECT id_restaurant,name,type, phone, opening_hours, commune FROM RESTAURANT NATURAL JOIN FAIRE_TYPE natural join TYPE');
$query->execute();
$restaurants = $query->fetchAll();
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script defer src="./static/js/carousel.js"></script>
<div class="hero">
    <div class="gauche">
        <h1>Recherchez et notez les meilleurs restaurants !</h1>
        <form action="/search" method="GET" class="search-container">
        <div class="location">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <span>Paris</span>
        </div>
        <input type="text" name="query" placeholder="Rechercher...">
        <button type="submit">RECHERCHE</button>
    </form>
    </div>
    <img class="food-image" src="../static/images/plat.png" alt="Plat savoureux">
</div>

<?php
$carousel = new RestauCarousel($restaurants);
echo $carousel->render();
?>

<div class="avis-container">
    <div class="avis-section">
        <div class="avis-contenu">
            <h1>Donnez-nous votre avis !</h1>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="dernier-avis">Dernier avis le : 20/01/25</p>
            <div class="avis">
                <p><strong>Stéphane ROBERT :</strong> 
                    <span class="stars-small">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </p>
                <div class="avis-message">
                    Super site ! J’adore, je le recommande à tous ceux qui ont faim !
                </div>
            </div>
            <button class="avis-btn">Écrire un avis</button>
        </div>
        <div class="image-container">
            <img src="../static/images/femme.png" alt="Personne souriante">
        </div>
    </div>
</div>




