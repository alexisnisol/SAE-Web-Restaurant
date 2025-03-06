<?php

namespace Tests;

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require ROOT . 'src/App/App.php';
require ROOT . 'src/Config/ConfigBD.php';

use PHPUnit\Framework\TestCase;
use App\Database\Database;
use App\Database\SQLiteDatabase;
use App;

class DatabaseTest extends TestCase {

    protected function setUp(): void {
        $db = App::getApp()->setDB('src/static/data/database.db');
    }

    public function testGetDB() {
        $db = App::getApp()->getDB();
        $this->assertNotNull($db);
    }

    public function testGetPDO() {
        $db = App::getApp()->getDB();
        $pdo = $db->getPDO();
        $this->assertNotNull($pdo);
    }

    // public function testGetDBWithConfig() {
    //     $db = Database::getDBWithConfig('mysql');
    //     $this->assertNotNull($db);
    // }

    // public function testGetPDOWithConfig() {
    //     $pdo = Database::getPDOWithConfig('mysql');
    //     $this->assertNotNull($pdo);
    // }

    // public function testGetDBWithConfigSQLite() {
    //     $db = Database::getDBWithConfig('sqlite');
    //     $this->assertNotNull($db);
    // }

    // public function testGetPDOWithConfigSQLite() {
    //     $pdo = Database::getPDOWithConfig('sqlite');
    //     $this->assertNotNull($pdo);
    // }

    // public function testGetDBWithConfigUnknown() {
    //     $db = Database::getDBWithConfig('unknown');
    //     $this->assertNull($db);
    // }

    // public function testGetPDOWithConfigUnknown() {
    //     $pdo = Database::getPDOWithConfig('unknown');
    //     $this->assertNull($pdo);
    // }

    // public function testDatabaseConnection()
    // {
    //     $db = new SQLiteDatabase('src/static/data/database.db');
    //     $this->assertNotNull($db->getPDO());
    // }
    
    // public function testDatabaseQuery()
    // {
    //     $db = new SQLiteDatabase('src/static/data/database.db');
    //     $result = $db->query('SELECT 1');
    //     $this->assertNotFalse($result);
    // }
}

?>

