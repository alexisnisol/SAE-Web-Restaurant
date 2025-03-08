<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Avis\Avis;
use App;

class AvisTest extends TestCase {

    protected function setUp(): void {
        App::getApp()->setDB('src/static/data/database.db');
    }
    
    public function testGetAvisUser() {
        $result = Avis::getAvisUser(1);
        $this->assertIsArray($result);
    }

    public function testGetNextAvisId() {
        $result = Avis::getNextAvisId();
        $this->assertIsInt($result);
    }
}

?>

