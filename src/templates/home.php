<?php

use App\Controllers\Carousel\RestauCarousel;
use App\Controllers\Restaurant\Restaurant;
use App\Controllers\Avis\Avis;

$restaurants = Restaurant::getRestaurantsNTType();
$types = Restaurant::getTypes();
$dernierAvis = Avis::getLastGoodAvis();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script defer src="./static/js/search.js"></script>
<script defer src="./static/js/carousel.js"></script>
<div class="hero">
    <div class="gauche">
        <h1>Recherchez et notez les meilleurs restaurants !</h1>
        <form action="/search" method="GET" class="search-container">
            <div class="location">
                <span><i class="fas fa-map-marker-alt"></i></span>
                <span>Orléans</span>
            </div>
            <input type="text" id="query" name="query" placeholder="Rechercher..." onfocus="showDropdown()" onblur="hideDropdown()" onkeyup="fetchResults(this.value)">
            <select name="type" id="type" onchange="fetchResults()">
                <?php
                echo "<option value=''>Tous les types</option>";
                foreach ($types as $type) {
                    $type = $type['type'];
                    echo "<option value='$type'>$type</option>";
                }
                ?>
            </select>
            <button type="submit">RECHERCHE</button>
        </form>

        <div class="dropdown" id="dropdown">
            <p>Résultats</p>
            <ul id="results-list"></ul>
        </div>
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
                <p class="dernier-avis">Dernier avis le : <?php echo $dernierAvis['date_avis'] ?? 'Aucun avis'; ?></p>
                <div class="avis">
                    <p><strong><?php echo $dernierAvis['user_nom'] ?? 'Utilisateur inconnu'; ?> :</strong> 
                        <span class="stars-small">
                            <?php
                            for ($i = 0; $i < ($dernierAvis['etoile'] ?? 0); $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            ?>
                        </span>
                    </p>
                    <div class="avis-message">
                        <?php echo $dernierAvis['avis'] ?? 'Pas de commentaire disponible.'; ?>
                    </div>
                </div>
                <button class="avis-btn" onclick="window.location.href='./index.php?action=avis'">Voir mes avis</button>
            </div>
            <div class="image-container">
                <img src="../static/images/femme.png" alt="Personne souriante">
            </div>
        </div>
    </div>