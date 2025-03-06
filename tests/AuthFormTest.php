<?php

namespace Tests;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Controllers\Auth\AuthForm;

class AuthFormTest extends TestCase {
    public function testCheckLoginFormWithWrongCredentials() {
        $result = AuthForm::checkLoginForm('wrong@example.com', 'password');
        $this->assertEquals("Nom d'utilisateur incorrect", $result);
    }

    public function testCheckRegisterFormWithValidData() {
        $result = AuthForm::checkRegisterForm('new@example.com', 'Password1', 'Password1', 'John', 'Doe');
        $this->assertEquals('', $result);
    }
}

?>

