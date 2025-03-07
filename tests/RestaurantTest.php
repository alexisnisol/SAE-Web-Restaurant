<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Restaurant\Restaurant;
use App;

class RestaurantTest extends TestCase {
    
    protected function setUp(): void {
        App::getApp(); 
        App::getApp()->setDB('src/static/data/database.db');
        var_dump(App::getApp()->getDB());
    }
    
    public function testGetRestaurant() {
        $result = Restaurant::getRestaurant(1);
        $this->assertIsArray($result);
    }

    public function testGetRestaurantsNJType()
    {
        $result = Restaurant::getRestaurantsNJType();
        $this->assertIsArray($result);
    }
}

?>

