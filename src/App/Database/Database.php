<?php

namespace App\Database;

abstract class Database implements IDatabase
{

    public function query($statement) {
        $pdo = $this->getPDO();
        return $pdo->query($statement);
    }

    public function execute($statement) {
        $pdo = $this->getPDO();
        return $pdo->exec($statement);
    }

    public function prepare($statement, $options = []) {
        $pdo = $this->getPDO();
        return $pdo->prepare($statement, $options);
    }

    public function loadContents() {
        if (!$this->databaseExists()) {
            $this->createDatabase();
        }
    }

    public function createDatabase() {
        $this->execute(file_get_contents(ROOT . '/static/data/createDB.sql'));
        $this->execute(file_get_contents(ROOT . '/static/data/insertDB.sql'));
    }

    public function getAllUsers() {
        $query = $this->prepare('SELECT * FROM UTILISATEUR');
        $query->execute();
        return $query->fetchAll();
    }
}