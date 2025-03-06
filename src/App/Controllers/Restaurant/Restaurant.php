<?php

namespace App\Controllers\Restaurant;

use App;

class Restaurant {

    static function getPosRestaurants() {
        $query = App::getApp()->getDB()->prepare('SELECT id_restaurant, name, latitude, longitude FROM RESTAURANT');
        $query->execute();
        return $query->fetchAll();
    }

    static function getRestaurant($id) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM RESTAURANT WHERE id_restaurant = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll();
    }

    static function getRestaurantsNTType() {
        $query = App::getApp()->getDB()->prepare('SELECT id_restaurant,name,type, phone, opening_hours, commune FROM RESTAURANT NATURAL JOIN FAIRE_TYPE natural join TYPE');
        $query->execute();
        return $query->fetchAll();
    }

    static function getTypeCuisineRestaurant($id) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM PROPOSER NATURAL JOIN TYPE_CUISINE WHERE id_restaurant = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll();
    }

    static function searchByName($name) {
        error_log($name);

        $nameParam = '%' . $name . '%';
        $query = App::getApp()->getDB()->prepare('SELECT * FROM RESTAURANT NATURAL JOIN FAIRE_TYPE NATURAL JOIN TYPE WHERE name LIKE :name');
        $query->bindParam(':name', $nameParam);
        $query->execute();
        return $query->fetchAll();
    }
}

