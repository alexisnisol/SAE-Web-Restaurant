<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Database\Database;

class DatabaseTest extends TestCase {

    public function testGetDB() {
        $db = Database::getDB();
        $this->assertNotNull($db);
    }

    public function testGetPDO() {
        $pdo = Database::getPDO();
        $this->assertNotNull($pdo);
    }

    public function testGetDBWithConfig() {
        $db = Database::getDBWithConfig('mysql');
        $this->assertNotNull($db);
    }

    public function testGetPDOWithConfig() {
        $pdo = Database::getPDOWithConfig('mysql');
        $this->assertNotNull($pdo);
    }

    public function testGetDBWithConfigSQLite() {
        $db = Database::getDBWithConfig('sqlite');
        $this->assertNotNull($db);
    }

    public function testGetPDOWithConfigSQLite() {
        $pdo = Database::getPDOWithConfig('sqlite');
        $this->assertNotNull($pdo);
    }

    public function testGetDBWithConfigUnknown() {
        $db = Database::getDBWithConfig('unknown');
        $this->assertNull($db);
    }

    public function testGetPDOWithConfigUnknown() {
        $pdo = Database::getPDOWithConfig('unknown');
        $this->assertNull($pdo);
    }

    public function testDatabaseConnection()
    {
        $db = new SQLiteDatabase('static/data/database.db');
        $this->assertNotNull($db->getPDO());
    }
    
    public function testDatabaseQuery()
    {
        $db = new SQLiteDatabase('static/data/database.db');
        $result = $db->query('SELECT 1');
        $this->assertNotFalse($result);
    }
}

?>

