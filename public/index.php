<?php

/**
 * ============================================================
 *  POINT D'ENTRÉE PRINCIPAL (Front Controller)
 * ============================================================
 * 
 * Ce fichier reçoit TOUTES les requêtes HTTP.
 * Il charge la config, les classes du noyau, définit les routes,
 * puis dispatche la requête vers le bon Controller@method.
 * 
 * FAIT :
 *   - Chargement de la config et des classes core
 *   - Définition des routes (landing, login, signup, logout, dashboard)
 *   - Dispatch via le Router
 * 
 *  À FAIRE (TODO) :
 *   - Ajouter un middleware d'authentification pour protéger les routes /dashboard/*
 *   - Gérer les routes POST séparément des routes GET (ex: POST /login, POST /signup)
 *   - Ajouter la gestion des erreurs 404 avec une vue dédiée
 *   - Ajouter les routes pour la gestion des étudiants (CRUD: create, show, update, delete)
 */

// --- Démarrage de la session (nécessaire pour l'authentification) ---
session_start();

// --- Chemin racine du projet ---
define('ROOT_PATH', dirname(__DIR__));

// --- Chargement des fichiers essentiels ---
require_once ROOT_PATH . '/config/config.php';   // Constantes DB_HOST, DB_USER, etc.
require_once ROOT_PATH . '/core/Router.php';      // Classe Router (add + dispatch)
require_once ROOT_PATH . '/core/Controller.php';  // Classe Controller de base (view + model)
require_once ROOT_PATH . '/core/Database.php';    // Classe Database (connexion PDO)

// --- Initialisation du routeur ---
$router = new Router();

// ============================================================
//  ROUTES PUBLIQUES (pas besoin d'être connecté)
// ============================================================

// Page d'accueil / Landing page
$router->add('/', 'AuthController@landing');

// Page de connexion (GET = afficher le formulaire, POST = traiter la connexion)
$router->add('/login', 'AuthController@login');

// Page d'inscription admin (GET = formulaire, POST = créer le compte)
// ⚠️ À SUPPRIMER EN PRODUCTION - sert uniquement à créer le premier admin
$router->add('/signup', 'AuthController@signup');

// Déconnexion (détruit la session et redirige vers /)
$router->add('/logout', 'AuthController@logout');

// ============================================================
//  ROUTES DU DASHBOARD (protégées par session)
//  TODO: Ajouter un middleware pour vérifier $_SESSION['admin_id']
// ============================================================

// Tableau de bord principal - affiche les statistiques
$router->add('/dashboard', 'DashboardController@index');

// Liste de tous les étudiants inscrits
// TODO: Brancher sur StudentController@index avec données réelles de la DB
$router->add('/etudiants', 'DashboardController@etudiants');

// Formulaire d'inscription d'un nouvel étudiant
// TODO: Gérer le POST pour sauvegarder en DB via StudentController@store
$router->add('/inscriptions', 'DashboardController@inscriptions');

// Calendrier scolaire
// TODO: Intégrer une librairie JS (ex: FullCalendar) et un CalendrierController
$router->add('/calendrier', 'DashboardController@calendrier');

// Paramètres du système (nom école, année scolaire, mot de passe)
// TODO: Gérer le POST pour sauvegarder les paramètres en DB
$router->add('/parametres', 'DashboardController@parametres');

// Détail d'un étudiant spécifique
// TODO: Passer l'ID en paramètre (ex: /etudiant/123) et charger depuis la DB
$router->add('/etudiant_detail', 'DashboardController@etudiantDetail');

// ============================================================
//  DISPATCH - le routeur analyse l'URL et appelle le bon contrôleur
// ============================================================
$router->dispatch($_SERVER['REQUEST_URI']);
