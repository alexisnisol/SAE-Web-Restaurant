<?php
namespace App\Controllers\Carousel;

use App\Controllers\Auth\Auth;
use App\Controllers\Like\LikeCuisine;
use App\Controllers\Like\LikeRestaurant;

class RestauCarousel {
    private $restaurants;

    public function __construct($restaurants) {
        $this->restaurants = $restaurants;
    }

    public function render() {
        $html = '<div class="section-restaurants">
                    <h1 class="titre-restaurants">Présentation de nos restaurants</h1>
                    <div class="restaurant-carousel">
                        <button class="carousel-btn prev-btn" onclick="moverestaurant(-1)">&#10094;</button>
                        <div class="carousel-track-container">
                            <div class="carousel-track">';
        
        $html .= $this->generateRestaurantItems();
        $html .= '       </div>
                        </div>
                        <button class="carousel-btn next-btn" onclick="moverestaurant(1)">&#10095;</button>
                    </div>
                </div>';

        if (Auth::isUserLoggedIn() && (! empty(LikeRestaurant::getRestaurantsAimes(Auth::getCurrentUser()->id)))) {
            $html .= '<div class="section-restaurants">
                        <h1 class="titre-restaurants">Vos restaurants favoris</h1>
                        <div class="restaurant-carousel">
                            <button class="carousel-btn prev-btn" onclick="moverestaurant(-1)">&#10094;</button>
                            <div class="carousel-track-container">
                                <div class="carousel-track">';
    
            $html .= $this->generateLikedRestaurantItems(Auth::getCurrentUser()->id);
    
            $html .= '       </div>
                            </div>
                            <button class="carousel-btn next-btn" onclick="moverestaurant(1)">&#10095;</button>
                        </div>
                    </div>';
        }
        
        if (Auth::isUserLoggedIn() && (! empty(LikeCuisine::getCuisineAime(Auth::getCurrentUser()->id)))) {
            $html .= '<div class="section-restaurants">
                    <h1 class="titre-restaurants">Selon vos types de cuisines préférés</h1>
                    <div class="restaurant-carousel">
                        <button class="carousel-btn prev-btn" onclick="moverestaurant(-1)">&#10094;</button>
                        <div class="carousel-track-container">
                            <div class="carousel-track">';

            $html .= $this->generateLikedCuisineItems(Auth::getCurrentUser()->id);  // Génère les items du carrousel

            $html .= '       </div>
                            </div>
                            <button class="carousel-btn next-btn" onclick="moverestaurant(1)">&#10095;</button>
                        </div>
                    </div>';
        }

        return $html;
    }

    private function generateRestaurantItems() {
        $itemsHtml = '';
        foreach ($this->restaurants as $restaurant) {
            $imageIndex = rand(1, 6);
    
            $itemsHtml .= '<a href="./index.php?action=visualisation&idRestau='. $restaurant['id_restaurant'].'" class="restaurant-box-link">
                            <div class="restaurant-box">
                                <img src="../static/images/plat-carousel' . $imageIndex . '.jpeg" alt="' . htmlspecialchars($restaurant['name']) . '">
                                <div class="restaurant-description">
                                    <h2>' . htmlspecialchars($restaurant['name']) . '</h2>
                                    <p>' . htmlspecialchars($restaurant['type']) . '</p>
                                    <p>' . htmlspecialchars($restaurant['commune']) . '</p>
                                    <p>' . htmlspecialchars($restaurant['phone']) . '</p>
                                </div>
                            </div>
                        </a>';
        }
        return $itemsHtml;
    }

    private function generateLikedCuisineItems($userId) {
        $itemsHtml = '';
        foreach (LikeCuisine::getRestaurantsCuisineAime($userId) as $restaurant) {
            $imageIndex = rand(1, 6);
    
            $itemsHtml .= '<a href="./index.php?action=visualisation&idRestau='. $restaurant['id_restaurant'].'" class="restaurant-box-link">
                            <div class="restaurant-box">
                                <img src="../static/images/plat-carousel' . $imageIndex . '.jpeg" alt="' . htmlspecialchars($restaurant['name']) . '">
                                <div class="restaurant-description">
                                    <h2>' . htmlspecialchars($restaurant['name']) . '</h2>
                                    <p>' . htmlspecialchars($restaurant['type']) . '</p>
                                    <p>' . htmlspecialchars($restaurant['commune']) . '</p>
                                    <p>' . htmlspecialchars($restaurant['phone']) . '</p>
                                    <p>' . htmlspecialchars($restaurant['opening_hours']) . '</p>
                                </div>
                            </div>
                        </a>';
        }
        return $itemsHtml;
    }

    private function generateLikedRestaurantItems($userId) {
        $itemsHtml = '';
        $likedRestaurants = LikeRestaurant::getRestaurantsAimes($userId);
    
        if (!empty($likedRestaurants)) {
            foreach ($likedRestaurants as $restaurant) {
                $imageIndex = rand(1, 6);
    
                $itemsHtml .= '<a href="./index.php?action=visualisation&idRestau='. $restaurant['id_restaurant'].'" class="restaurant-box-link">
                                <div class="restaurant-box">
                                    <img src="../static/images/plat-carousel' . $imageIndex . '.jpeg" alt="' . htmlspecialchars($restaurant['name']) . '">
                                    <div class="restaurant-description">
                                        <h2>' . htmlspecialchars($restaurant['name']) . '</h2>
                                        <p>' . htmlspecialchars($restaurant['type']) . '</p>
                                        <p>' . htmlspecialchars($restaurant['commune']) . '</p>
                                        <p>' . htmlspecialchars($restaurant['phone']) . '</p>
                                        <p>' . htmlspecialchars($restaurant['opening_hours']) . '</p>
                                    </div>
                                </div>
                            </a>';
            }
        } else {
            $itemsHtml .= '<p>Aucun restaurant favori enregistré.</p>';
        }
        
        return $itemsHtml;
    }
    
}

?>
