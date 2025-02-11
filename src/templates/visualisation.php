<?php
use App\Controllers\Auth\Auth;
use App\Database\Avis;
use App\Database\Restaurant;

$idRestau = $_GET['idRestau'];
$restaurant = Restaurant::getRestaurant($idRestau);

$restaurant = $restaurant[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::isUserLoggedIn()) {
    if (isset($_POST['review']) && isset($_POST['rate'])) {
        $avisText = $_POST['review'];
        $avisEtoiles = $_POST['rate'];
        $userId = Auth::getCurrentUser()->id;
        
        if (!empty($avisText)) {
            Avis::insertAvis($userId, $idRestau, $avisEtoiles, $avisText);
            
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } 
    } elseif (isset($_POST['delete_review'])) {
        $idAvis = $_POST['delete_review'];
        Avis::deleteAvis($idAvis);
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
            <div class="title">
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
            </div>
            <textarea name="review" id="review" cols="30" rows="10" required></textarea>
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
            $les_avis = Avis::getAvisUser($idRestau);
        ?>
        <?php if (empty($les_avis)) : ?>
                <div class="review no-review">
                    <p><?php echo $restaurant['name'] ?> n'as pas d'avis pour le moment. </p>
                </div>
        <?php else : ?>
            <?php foreach ($les_avis as $avis) : ?>
                <div class="review">
                    <span class="name"><?php echo $avis["nom"] . " " . $avis["prenom"] ?></span> 
                    <?php for ($i = 0; $i < 5; $i++) {
                        if ($avis["etoile"] > $i) {
                            echo '⭐';
                        } else {
                            echo '☆';
                        }
                    }
                    ?>
                    <p class="date">Posté le : <?php echo $avis["date_avis"] ?></p>
                    <p><?php echo $avis["avis"] ?></p>
                    <?php if (Auth::isUserLoggedIn() && Auth::getCurrentUser()->isAdmin()) : ?>
                        <form action="" method="post" class="delete-form">
                            <input type="hidden" name="delete_review" value="<?php echo $avis['id_avis']; ?>">
                            <button type="submit" class="delete-btn">🗑 Supprimer</button>
                        </form>
                    <?php endif ?>
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


