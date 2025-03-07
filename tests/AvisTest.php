<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Avis\Avis;
use App;

class AvisTest extends TestCase {

    protected function setUp(): void {
        App::getApp()->setDB('src/static/data/database.db');
    }
    
    public function testInsertAvis() {
        $this->expectNotToPerformAssertions();
        Avis::insertAvis(1, 1, 5, 'Excellent restaurant');
    }
    
    public function testGetAvisUser() {
        $result = Avis::getAvisUser(1);
        $this->assertIsArray($result);
    }

    public function testDeleteAvis() {
        $this->expectNotToPerformAssertions();
        Avis::deleteAvis(1);
    }

    public function testGetNextAvisId() {
        $result = Avis::getNextAvisId();
        $this->assertIsInt($result);
    }
}

?>

