<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Auth\Users\User;
use App\Controllers\Auth\Users\Role;

class UserTest extends TestCase {
    public function testUserRole() {
        $user = new User(1, 'John', 'Doe', 'john@example.com', 'password', 'ADMIN');
        $this->assertEquals($user->getRole(), Role::ADMIN);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isClient());
        $this->assertFalse($user->isModerator());
    }
    
    public function testPasswordHashing() {
        $user = new User(1, 'John', 'Doe', 'john@example.com', 'password');
        $user->hashPassword();
        $this->assertNotEquals('password', $user->password);
    }
}

?>

