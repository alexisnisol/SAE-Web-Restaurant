<?php

namespace App\Database;

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
}

