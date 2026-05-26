<?php
// Entry point
define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/core/Router.php';
require_once ROOT_PATH . '/core/Controller.php';
require_once ROOT_PATH . '/core/Database.php';

$router = new Router();

// Add basic routes
$router->add('/', 'HomeController@index');

$router->dispatch($_SERVER['REQUEST_URI']);
