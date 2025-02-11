<?php
error_reporting(0);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require ROOT . '/App/App.php';

App::getApp();

use App\Views\Router;
$router = new Router();
$router->execute();
?>