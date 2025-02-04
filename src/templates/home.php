<?php

use App\Controllers\Carousel\RestauCarousel;

$query = App::getApp()->getDB()->prepare('SELECT id_restaurant,name,type, phone, opening_hours, commune FROM RESTAURANT');
$query->execute();
$restaurants = $query->fetchAll();

$restaurants2



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

