<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Auth\AuthForm;
use App;

class AuthFormTest extends TestCase {

    protected function setUp(): void {
        App::getApp()->setDB('src/static/data/database.db');
    }

    public function testCheckLoginFormWithWrongCredentials() {
        $result = AuthForm::checkLoginForm('wrong@example.com', 'password');
        $this->assertEquals("Nom d'utilisateur incorrect", $result);
    }

    public function testCheckRegisterFormWithValidData() {
        $result = AuthForm::checkRegisterForm('new@example.com', 'Password1', 'Password1', 'John', 'Doe');
        $this->assertEquals('Un utilisateur avec cet email existe déjà', $result);
    }
}

?>

