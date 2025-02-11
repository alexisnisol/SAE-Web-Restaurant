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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::isUserLoggedIn()) {
    $avisText = $_POST['review'];
    $avisEtoiles = $_POST['rate'];
    $userId = Auth::getCurrentUser()->id;
    
    if (!empty($avisText)) {
        $insertQuery = App::getApp()->getDB()->prepare('INSERT INTO AVIS (id_avis, id_utilisateur, id_restaurant, etoile, avis) VALUES (:idAvis, :userId, :idRestau, :etoile, :avis)');
        $insertQuery->bindParam(':idAvis', Auth::getNextAvisId());
        $insertQuery->bindParam(':userId', $userId);
        $insertQuery->bindParam(':idRestau', $idRestau);
        $insertQuery->bindParam(':etoile', $avisEtoiles);
        $insertQuery->bindParam(':avis', $avisText);
        $insertQuery->execute();

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } 
}

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
            <p><?php echo Auth::getCurrentUser()->id_utilisateur ?></p>
        </div>
    </div>

    <?php if (Auth::isUserLoggedIn()): ?>
        <!-- Formulaire d'avis -->
        <form action="" method="post" class="review-form">
            <label for="review">Votre avis :</label>
            <div class="rating">
                <input value="5" name="rate" id="star5" type="radio">
                <label title="text" for="star5"></label>
                <input value="4" name="rate" id="star4" type="radio">
                <label title="text" for="star4"></label>
                <input value="3" name="rate" id="star3" type="radio" checked="">
                <label title="text" for="star3"></label>
                <input value="2" name="rate" id="star2" type="radio">
                <label title="text" for="star2"></label>
                <input value="1" name="rate" id="star1" type="radio">
                <label title="text" for="star1"></label>
            </div>
            <textarea name="review" id="review" cols="30" rows="10"></textarea>
            <input type="submit" value="Envoyer">
        </form>

        <?php if (Auth::getCurrentUser()->isAdmin()) : ?>
            <a href="index.php?action=dashboard" class="btn-se-connecter">Dashboard</a>
        <?php endif; ?>

        <a href="index.php?action=logout" class="btn-se-connecter">Déconnexion</a>
    <?php else : ?>
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
        ?>
        <?php if (empty($les_avis)) : ?>
                <div class="review no-review">
                    <p><?php $restaurant['name'] ?> n'as pas d'avis pour le moment. </p>
                </div>
        <?php else : ?>
            <?php foreach ($les_avis as $avis) : ?>
                <div class="review">
                    <span class="name"><?php echo $avis["nom"] . " " . $avis["prenom"] ?></span> ⭐⭐⭐⭐⭐
                    <p class="date">Posté le : <?php echo $avis["date_avis"] ?></p>
                    <p><?php echo $avis["avis"] ?></p>
                </div>
            <?php endforeach ?>
        <?php endif ?>

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