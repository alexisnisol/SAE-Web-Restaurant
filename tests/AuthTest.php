<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Auth\Auth;
use App\Controllers\Auth\Users\User;
use App\Controllers\Auth\Users\Role;

class AuthTest extends TestCase {
    public function testSetUserSession() {
        $user = new User(1, 'John', 'Doe', 'john@example.com', 'password', 'CLIENT');
        Auth::setUserSession($user);
        $this->assertTrue(isset($_SESSION['user']));
    }

    public function testIsUserLoggedIn() {
        $_SESSION['user'] = serialize(new User(1, 'John', 'Doe', 'john@example.com', 'password', 'CLIENT'));
        $this->assertTrue(Auth::isUserLoggedIn());
    }

    public function testGetCurrentUser() {
        $_SESSION['user'] = serialize(new User(1, 'John', 'Doe', 'john@example.com', 'password', 'CLIENT'));
        $user = Auth::getCurrentUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(Auth::getCurrentUser()->id, 1);
        $this->assertEquals(Auth::getCurrentUser()->firstName, 'John');
        $this->assertEquals(Auth::getCurrentUser()->lastName, 'Doe');
        $this->assertEquals(Auth::getCurrentUser()->email, 'john@example.com');
        $this->assertEquals(Auth::getCurrentUser()->password, 'password');
        $this->assertEquals(Auth::getCurrentUser()->role, Role::CLIENT);
    }
}

?>

