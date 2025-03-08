<?php

namespace App\Controllers\Like;

use App;

class LikeRestaurant {

    static function getRestaurantsAimes($userId) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM RESTAURANT NATURAL JOIN RESTAURANT_AIME WHERE id_utilisateur = :userId');
        $query->bindParam(':userId', $userId);
        $query->execute();
        return $query->fetchAll();
    }

    static function getRestaurantsCuisineAimes($userId) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM RESTAURANT NATURAL JOIN RESTAURANT_AIME NATURAL JOIN PROPOSER WHERE id_restaurant IN (SELECT id_restaurant FROM RESTAURANT_AIME WHERE id_utilisateur = :userId)');
        $query->bindParam(':userId', $userId);
        $query->execute();
        return $query->fetchAll();
    }

    public static function isRestaurantLiked($userId, $restaurantId) {
        $query = App::getApp()->getDB()->prepare("SELECT * FROM RESTAURANT_AIME WHERE id_utilisateur = ? AND id_restaurant = ?");
        $query->execute([$userId, $restaurantId]);
        return $query->fetch() !== false;
    }
    
    public static function likeRestaurant($userId, $restaurantId) {
        $query = App::getApp()->getDB()->prepare("INSERT INTO RESTAURANT_AIME (id_utilisateur, id_restaurant) VALUES (?, ?)");
        $query->execute([$userId, $restaurantId]);
    }
    
    
    public static function unlikeRestaurant($userId, $restaurantId) {
        $query = App::getApp()->getDB()->prepare("DELETE FROM RESTAURANT_AIME WHERE id_utilisateur = ? AND id_restaurant = ?");
        $query->execute([$userId, $restaurantId]);
    }
}

?>
