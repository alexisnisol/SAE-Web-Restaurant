<?php
use App\Controllers\Auth\Auth;

$idRestau = $_GET['idRestau'];
$query = App::getApp()->getDB()->prepare('SELECT * FROM RESTAURANT WHERE id_restaurant = :id');
$query->bindParam(':id', $idRestau);
$query->execute();
$restaurant = $query->fetchAll();

$restaurant = $restaurant[0];

// echo $restaurant['name'];
// print_r($restaurant);

?>
<div class="container">
    <!-- En-tête du restaurant -->
    <div class="restaurant-header">
        <img src="#" alt="Image du restaurant">
        <div class="restaurant-info">
            <h2><?php echo $restaurant['name'] ?></h2>
            <p><?php echo $restaurant['departement'] . ", " . $restaurant['region'] . ", " . $restaurant['commune'] ?></p>
            <!-- <p>Département, commune, code_commune</p> -->
            <p>📞 <?php echo $restaurant['phone'] ?></p>
            <p>Types de cuisine ❤️</p>
            <!-- <p>Note Moyenne du restaurant : <span class="rating">4.5 ⭐</span></p> -->
        </div>
    </div>

    <?php if (Auth::isUserLoggedIn()): ?>
        <!-- Formulaire d'avis -->
        <form action="" method="post" class="review-form">
            <label for="review">Votre avis :</label>
            <textarea name="review" id="review" cols="30" rows="10"></textarea>
            <input type="submit" value="Envoyer">
        </form>

        <?php if (Auth::getCurrentUser()->isAdmin()): ?>
            <a href="index.php?action=dashboard" class="btn-se-connecter">Dashboard</a>
        <?php endif; ?>

        <a href="index.php?action=logout" class="btn-se-connecter">Déconnexion</a>
    <?php else: ?>
        <!-- Message de connexion -->
        <p class="login-message">Veuillez vous connecter pour laisser un avis...</p>
    <?php endif; ?>

    <!-- Avis -->
    <div class="reviews">
        <h3>Les avis :</h3>
        <?php 
            $query = App::getApp()->getDB()->prepare('SELECT * FROM AVIS NATURAL JOIN UTILISATEUR');
            $query->execute();
            $les_avis = $query->fetchAll();

            if (sizeof($les_avis) == 0) {
                echo "<div class=\"review no-review\"><p>" . $restaurant['name'] . " n'as pas d'avis pour le moment. </p></div>";
            }
        ?>
        <div class="review">
            <span class="name">Jean Jacques</span> ⭐⭐⭐⭐⭐
            <p class="date">Posté le : 21/01/25</p>
            <p>Super application, j'ai pu retrouver facilement mes restaurants préférés ! Je le conseille vivement à tout le monde.</p>
        </div>
        <div class="review">
            <span class="name">Jean Jacques</span> ⭐⭐⭐⭐⭐
            <p class="date">Posté le : 21/01/25</p>
            <p>Super application, j'ai pu retrouver facilement mes restaurants préférés ! Je le conseille vivement à tout le monde.</p>
        </div>
        <div class="review">
            <span class="name">Jean Jacques</span> ⭐⭐⭐⭐⭐
            <p class="date">Posté le : 21/01/25</p>
            <p>Super application, j'ai pu retrouver facilement mes restaurants préférés ! Je le conseille vivement à tout le monde.</p>
        </div>
    </div>

    <!-- Carte -->
    <div class="map">
        <h3>Localisation :</h3>
        <div id="map"></div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script> 
<script src="./static/js/map.js"></script>

<script>
    let addresses = [
        {
            lat: <?php echo $restaurant['latitude'] ?>,   // Ajout de la latitude
            lng: <?php echo $restaurant['longitude'] ?>,   // Ajout de la longitude
            name: "<?php echo $restaurant['name'] ?>"
        }
    ];
</script>

<!-- <script>
    var addresses = [
        {% for point in points_de_collecte %}
    {
        lat: {{ point.latitude }},   // Ajout de la latitude
        lng: {{ point.longitude }},   // Ajout de la longitude
        name: "{{ point.nom_pt_collecte }}",
        detailUrl: "{{ url_for('detaille', id=point.id_point_de_collecte) }}"
    },
    {% endfor %}
    ];
</script> -->