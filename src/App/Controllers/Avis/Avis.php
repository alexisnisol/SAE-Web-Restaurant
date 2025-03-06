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

    static function getAllAvisByUser($userId) {
        $query = App::getApp()->getDB()->prepare(
            'SELECT a.id_avis, a.id_utilisateur, a.id_restaurant, a.etoile, a.avis, a.date_avis, 
                    r.name AS restaurant_name, u.nom AS user_nom, u.prenom AS user_prenom 
             FROM AVIS a
             JOIN RESTAURANT r ON a.id_restaurant = r.id_restaurant
             JOIN UTILISATEUR u ON a.id_utilisateur = u.id_utilisateur
             WHERE a.id_utilisateur = :userId'
        );
        
        $query->bindParam(':userId', $userId);
        $query->execute();
        return $query->fetchAll();
    }

    static function deleteAvis($idAvis) {
        $query = App::getApp()->getDB()->prepare('DELETE FROM AVIS WHERE id_avis = :id');
        $query->bindParam(':id', $idAvis);
        $query->execute();
    }
}

