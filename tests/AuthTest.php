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
    }
}

?>

