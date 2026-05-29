<?php
/**
 * TODO:
 * - Ajouter un middleware d'authentification pour protéger les routes /dashboard/*
 * - Gérer les routes POST séparément des routes GET (ex: POST /login, POST /signup)
 * - Ajouter la gestion des erreurs 404 avec une vue dédiée
 * - Ajouter les routes pour la gestion des étudiants (CRUD: create, show, update, delete)
 * - Brancher sur StudentController@index avec données réelles de la DB pour /etudiants
 * - Gérer le POST pour sauvegarder en DB via StudentController@store pour /inscriptions
 * - Intégrer une librairie JS (ex: FullCalendar) et un CalendrierController
 * - Gérer le POST pour sauvegarder les paramètres en DB
 * - Passer l'ID en paramètre (ex: /etudiant/123) et charger depuis la DB pour /etudiant_detail
 */

session_start();

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/core/Router.php';
require_once ROOT_PATH . '/core/Controller.php';
require_once ROOT_PATH . '/core/Database.php';

$router = new Router();

$router->add('/', 'admin/AuthController@landing');
$router->add('/login', 'admin/AuthController@login');
$router->add('/signup', 'admin/AuthController@signup');
$router->add('/logout', 'admin/AuthController@logout');

$router->add('/dashboard', 'admin/DashboardController@index');
$router->add('/calendrier', 'admin/CalendrierController@index');
$router->add('/parametres', 'admin/ParametresController@parametres');

$router->add('/etudiants', 'student/EtudiantsController@index');
$router->add('/inscriptions', 'student/InscriptionController@index');
$router->add('/etudiant_detail', 'student/EtudiantDetailController@index');

$router->dispatch($_SERVER['REQUEST_URI']);
