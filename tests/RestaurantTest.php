<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Restaurant\Restaurant;
use App;

class RestaurantTest extends TestCase {
    
    protected function setUp(): void {
        App::getApp(); 
    }
    
    public function testInsertRestaurant() {
        $this->expectNotToPerformAssertions();
        Restaurant::insertRestaurant('Restaurant test', 'Description test', 'test.jpg', 1);
    }
    
    public function testGetRestaurant() {
        $result = Restaurant::getRestaurant(1);
        $this->assertIsArray($result);
    }

    public function testDeleteRestaurant() {
        $this->expectNotToPerformAssertions();
        Restaurant::deleteRestaurant(1);
    }

    public function testGetNextRestaurantId() {
        $result = Restaurant::getNextRestaurantId();
        $this->assertIsInt($result);
    }

    public function testGetRestaurantsNTType()
    {
        $result = Restaurant::getRestaurantsNTType();
        $this->assertIsArray($result);
    }
}

?>

