<?php

namespace App\Controllers\LikeCuisine;

use App;

class LikeCuisine {

    static function getCuisineAime($userId) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM CUISINE_AIME NATURAL JOIN TYPE_CUISINE WHERE id_utilisateur = :userId');
        $query->bindParam(':userId', $userId);
        $query->execute();
        return $query->fetchAll();
    }

    static function getRestaurantsCuisineAime($userId) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM RESTAURANT NATURAL JOIN PROPOSER NATURAL JOIN TYPE_CUISINE WHERE id_cuisine IN (SELECT id_cuisine FROM CUISINE_AIME WHERE id_utilisateur = :userId)');
        $query->bindParam(':userId', $userId);
        $query->execute();
        return $query->fetchAll();
    }

    public static function isCuisineLiked($userId, $cuisineId) {
        $query = App::getApp()->getDB()->prepare("SELECT * FROM CUISINE_AIME WHERE id_utilisateur = ? AND id_cuisine = ?");
        $query->execute([$userId, $cuisineId]);
        return $query->fetch() !== false;
    }
    
    public static function likeCuisine($userId, $cuisineId) {
        $query = App::getApp()->getDB()->prepare("INSERT INTO CUISINE_AIME (id_utilisateur, id_cuisine) VALUES (?, ?)");
        $query->execute([$userId, $cuisineId]);
    }
    
    public static function unlikeCuisine($userId, $cuisineId) {
        $query = App::getApp()->getDB()->prepare("DELETE FROM CUISINE_AIME WHERE id_utilisateur = ? AND id_cuisine = ?");
        $query->execute([$userId, $cuisineId]);
    }
}

