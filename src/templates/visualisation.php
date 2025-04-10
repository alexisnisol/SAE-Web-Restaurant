<?php
use App\Controllers\Auth\Auth;
use App\Controllers\Auth\Users\User;
use App\Controllers\Avis\Avis;
use App\Controllers\Restaurant\Restaurant;
use App\Controllers\Like\LikeRestaurant;
use App\Controllers\Like\LikeCuisine;

$idRestau = $_GET['idRestau'];
$restaurant = Restaurant::getRestaurant($idRestau);

$restaurant = $restaurant[0];

// Cuisine

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

// Restaurant

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::isUserLoggedIn()) {
    $userId = Auth::getCurrentUser()->id;

    if (isset($_POST['like_restaurant'])) {
        $restaurantId = $_POST['restaurant_id'];

        if (LikeRestaurant::isRestaurantLiked($userId, $restaurantId)) {
            LikeRestaurant::unlikeRestaurant($userId, $restaurantId);
        } else {
            LikeRestaurant::likeRestaurant($userId, $restaurantId);
        }

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}


?>
<div class="container">
    <div class="restaurant-header">
        <img src="<?php echo Restaurant::getRestaurantImage($restaurant['name']) ?>" alt="Image du restaurant <?php echo $restaurant['name'] ?>">
        <div class="restaurant-info">
        <?php
            $userId = Auth::getCurrentUser()->id;
            $isRestaurantLiked = LikeRestaurant::isRestaurantLiked($userId, $restaurant['id_restaurant']);
            $moyAvis = Avis::getMoyAvisRestau($restaurant['id_restaurant']);
        ?>

        <h2 style="display:inline;"><?php echo $restaurant['name']; ?></h2>
        <?php if (isset($moyAvis['moy']) && $moyAvis['moy'] !== null): ?>
            <p style="display:inline;"><?php echo " ({$moyAvis['moy']}⭐)"; ?></p>
        <?php endif; ?>

        <form action="" method="post" style="display:inline;">
            <input type="hidden" name="restaurant_id" value="<?php echo $restaurant['id_restaurant']; ?>">
            <button type="submit" name="like_restaurant" style="background: none; border: none; cursor: pointer; font-size: 20px;">
                <?php echo $isRestaurantLiked ? "❤️" : "♡"; ?>
            </button>
        </form>

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
                $moyenne = Avis::getMoyAvisRestau($restaurant['id_restaurant'])['moy'];
                if (!empty($moyenne)) {
                    $fullStars = floor($moyenne);
                    $halfStar = ($moyenne - $fullStars) >= 0.5 ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;
                
                    echo "<p><strong>Note Moyenne : </strong>";
                    for ($i = 0; $i < $fullStars; $i++) {
                        echo "⭐";
                    }
                    if ($halfStar) {
                        echo "⭐️"; // Utilisez une icône ou une image pour la demi-étoile
                    }
                    for ($i = 0; $i < $emptyStars; $i++) {
                        echo "☆";
                    }
                    echo "</p>";
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
                if (! empty($restaurant["website"])) {
                    echo "<p><strong>Site web : </strong><a target='_blank' href='" . $restaurant['website']. "'>" . $restaurant['website'] . "<a/></p>";
                }
            ?>
            <p><?php echo Auth::getCurrentUser()->id_utilisateur ?></p>
        </div>
    </div>

    <?php if (Auth::isUserLoggedIn()): ?>
        <!-- Formulaire d'avis -->
        <form action="" method="post" class="review-form">
            <div class="title">
                <label for="review">Votre avis :</label>
                <div class="rating">
                    <input value="5" name="rate" id="star5" type="radio"required>
                    <label title="text" for="star5"></label>
                    <input value="4" name="rate" id="star4" type="radio"required>
                    <label title="text" for="star4"></label>
                    <input value="3" name="rate" id="star3" type="radio" required>
                    <label title="text" for="star3"></label>
                    <input value="2" name="rate" id="star2" type="radio"required>
                    <label title="text" for="star2"></label>
                    <input value="1" name="rate" id="star1" type="radio"required>
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

                    <?php if (Auth::isUserLoggedIn() && (Auth::getCurrentUser()->isAdmin() || Auth::getCurrentUser()->isModerator())) : ?>
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
