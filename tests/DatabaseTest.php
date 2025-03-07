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
    
    public function testDatabaseQuery()
    {
        // $db = new SQLiteDatabase('src/static/data/database.db');
        $db = App::getApp()->getDB();
        $result = $db->query('SELECT 1');
        $this->assertNotFalse($result);
    }
}

?>

