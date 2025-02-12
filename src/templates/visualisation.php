<?php
use App\Controllers\Auth\Auth;
use App\Controllers\Avis\Avis;
use App\Controllers\Restaurant\Restaurant;
use App\Controllers\LikeCuisine\LikeCuisine;

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
    } elseif (isset($_POST['like'])) {
        $cuisine = $_POST['cuisine'];
        $userId = Auth::getCurrentUser()->id;
    
        if (LikeCuisine::isCuisineLiked($userId, $cuisine)) {
            LikeCuisine::unlikeCuisine($userId, $cuisine);
        } else {
            LikeCuisine::likeCuisine($userId, $cuisine);
        }
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}

?>
<div class="container">
    <!-- En-tête du restaurant -->
    <div class="restaurant-header">
        <img src="./static/images/plat-carousel<?php echo $imageIndex = rand(1, 6) ?>.jpeg" alt="Image du restaurant">
        <div class="restaurant-info">
            <h2><?php echo $restaurant['name'] ?></h2>
            <p><strong>Lieu : </strong><?php echo $restaurant['region'] . ", " . $restaurant['departement'] . ", " . $restaurant['commune'] ?></p>
            <?php 
                if (! empty($restaurant['brand'])) {
                    echo "<p><strong>Marque : </strong>" . $restaurant['brand'] . "</p>";
                }
                if (! empty($restaurant['opening_hours'])) {
                    echo "<p><strong>Horaires : </strong>" . $restaurant['opening_hours'] . "</p>";
                }
                if (! empty($restaurant['phone'])) {
                    echo "<p><strong>Tel : </strong>📞 " . $restaurant['phone'] . "</p>";
                }
                if (! empty($restaurant['wheelchair']) || ! empty($restaurant['vegetarian']) || ! empty($restaurant['vegan']) || ! empty($restaurant['delivery']) || ! empty($restaurant['takeaway']) || ! empty($restaurant['internet_access']) || ! empty($restaurant['drive_through'])) {
                    echo "<div class='cuisines'><p><strong>Services : </strong></p><ul>";
                    if (! empty($restaurant['wheelchair'])) {
                        echo "<li>Accès fauteuil roulant</li>";
                    }
                    if (! empty($restaurant['vegetarian'])) {
                        echo "<li>Options végétariennes</li>";
                    }
                    if (! empty($restaurant['vegan'])) {
                        echo "<li>Options véganes</li>";
                    }
                    if (! empty($restaurant['delivery'])) {
                        echo "<li>Livraison</li>";
                    }
                    if (! empty($restaurant['takeaway'])) {
                        echo "<li>À emporter</li>";
                    }
                    if (! empty($restaurant['internet_access'])) {
                        echo "<li>Accès internet</li>";
                    }
                    if (! empty($restaurant['drive_through'])) {
                        echo "<li>Drive-through</li>";
                    }
                    echo "</ul></div>";
                }
                $typeCuisines = Restaurant::getTypeCuisineRestaurant($idRestau);
                if (! empty($typeCuisines)) {
                    echo "<div class='cuisines'><p><strong>Types de cuisine ❤️ : </strong></p>";
                    echo "<ul>";
                        foreach ($typeCuisines as $cuisine) {
                            // echo "<li>" . $cuisine["cuisine"] . "</li>";
                            $isLiked = LikeCuisine::isCuisineLiked(Auth::getCurrentUser()->id, $cuisine["id_cuisine"]);
                            echo "<li>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='cuisine' value='" . $cuisine["id_cuisine"] . "'>";
                            echo "<button type='submit' name='like' style='background: none; border: none; cursor: pointer; font-size: 16px;'>";
                            echo $cuisine["cuisine"] . " " . ($isLiked ? "❤️" : "♡");
                            echo "</button>";
                            echo "</form>";
                            echo "</li>";
                        }
                    echo "</ul></div>";
                }
            ?>
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
                            <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet avis ?')">🗑 Supprimer</button>
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


