<?php

namespace App\Controllers\Avis;

use App;

class Avis {

    static function getNextAvisId() {
        $query = App::getApp()->getDB()->query('SELECT MAX(id_avis) as max_id FROM AVIS');
        $result = $query->fetch();
        return $result['max_id'] + 1;
    }

    static function insertAvis($userId, $idRestau, $etoile, $avis) {
        $query = App::getApp()->getDB()->prepare('INSERT INTO AVIS (id_avis, id_utilisateur, id_restaurant, etoile, avis) VALUES (:idAvis, :userId, :idRestau, :etoile, :avis)');
        $query->bindParam(':idAvis', Avis::getNextAvisId());
        $query->bindParam(':userId', $userId);
        $query->bindParam(':idRestau', $idRestau);
        $query->bindParam(':etoile', $etoile);
        $query->bindParam(':avis', $avis);
        $query->execute();
    }

    static function getAvisUser($idRestau) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM AVIS NATURAL JOIN UTILISATEUR WHERE id_restaurant = :id');
        $query->bindParam(':id', $idRestau);
        $query->execute();
        return $query->fetchAll();
    }

    static function deleteAvis($idAvis) {
        $query = App::getApp()->getDB()->prepare('DELETE FROM AVIS WHERE id_avis = :id');
        $query->bindParam(':id', $idAvis);
        $query->execute();
    }

    static function deleteLastAvis() {
        $query = App::getApp()->getDB()->query('SELECT MAX(id_avis) as max_id FROM AVIS');
        $result = $query->fetch();
        if ($result) {
            $query = App::getApp()->getDB()->prepare('DELETE FROM AVIS WHERE id_avis = :id');
            $query->bindParam(':id', $result['max_id']);
            $query->execute();
        }
    }

    static function moyenneRestaurant($idRestau) {
        $query = App::getApp()->getDB()->prepare('SELECT AVG(etoile) as moyenne FROM AVIS WHERE id_restaurant = :id');
        $query->bindParam(':id', $idRestau);
        $query->execute();
        $result = $query->fetch();
        return $result['moyenne'];
    }
}

