<?php

session_start();

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/core/Router.php';
require_once ROOT_PATH . '/core/Controller.php';
require_once ROOT_PATH . '/core/Database.php';

$router = new Router();

// =====================================================
// ===== PAGE D'ACCUEIL (LANDING PAGE) =====
// =====================================================
$router->add('/', 'HomeController@index');

// =====================================================
// ===== AUTHENTIFICATION PERSONNEL (Secrétaire, DG, Professeur) =====
// =====================================================
$router->add('/login_personnel', 'PersonnelAuthController@login');
$router->add('/logout_personnel', 'PersonnelAuthController@logout');

// =====================================================
// ===== ESPACE ÉTUDIANT =====
// =====================================================
$router->add('/portail_etudiant', 'etudiant/EtudiantController@portail');
$router->add('/etudiant/login', 'etudiant/EtudiantController@login');
$router->add('/etudiant/inscription', 'etudiant/EtudiantController@inscription');
$router->add('/etudiant/dashboard', 'etudiant/EtudiantController@dashboard');
$router->add('/etudiant/logout', 'etudiant/EtudiantController@logout');

// =====================================================
// ===== ESPACE SECRÉTAIRE =====
// =====================================================
$router->add('/secretaire/dashboard', 'secretaire/SecretaireController@dashboard');
$router->add('/secretaire/dossiers', 'secretaire/SecretaireController@dossiers');
$router->add('/secretaire/valider_dossier', 'secretaire/SecretaireController@validerDossier');
$router->add('/secretaire/candidatures', 'secretaire/SecretaireController@candidaturesProfesseur');

// Gestion Filières (Secrétaire)
$router->add('/filieres', 'secretaire/FilieresController@index');
$router->add('/filieres/create', 'secretaire/FilieresController@create');
$router->add('/filiere_detail', 'secretaire/FilieresController@detail');
$router->add('/filiere_delete', 'secretaire/FilieresController@delete');

// Gestion Matières (Secrétaire)
$router->add('/matieres', 'secretaire/MatieresController@index');
$router->add('/matieres/create', 'secretaire/MatieresController@create');
$router->add('/matieres/delete', 'secretaire/MatieresController@delete');
$router->add('matieres/detail', 'secretaire/MatieresController@detail');

// Gestion Salles (Secrétaire)
$router->add('/salles', 'secretaire/SallesController@index');
$router->add('/salles/create', 'secretaire/SallesController@create');
$router->add('/salles/update_etat', 'secretaire/SallesController@updateEtat');
$router->add('/salles/delete', 'secretaire/SallesController@delete');

// Gestion Emploi du Temps & Salles (Secrétaire)
$router->add('/calendrier', 'secretaire/CalendrierController@index');
$router->add('/calendrier/api_matieres', 'secretaire/CalendrierController@apiGetMatieres');
$router->add('/calendrier/api_save', 'secretaire/CalendrierController@apiSaveCours');
$router->add('/parametres', 'secretaire/ParametresController@parametres');

// Gestion étudiants (Secrétaire) – CRUD admin
$router->add('/etudiants', 'etudiant/EtudiantsController@index');
$router->add('/inscriptions', 'etudiant/InscriptionController@index');
$router->add('/etudiant_detail', 'etudiant/EtudiantDetailController@index');
$router->add('/etudiant_toggle_statut', 'etudiant/EtudiantDetailController@toggleStatut');
$router->add('/modifier_etudiant_save', 'etudiant/EtudiantDetailController@update');

// =====================================================
// ===== ESPACE DG =====
// =====================================================
$router->add('/dg/dashboard', 'dg/DgController@dashboard');
$router->add('/dg/professeurs', 'dg/DgController@professeurs');
$router->add('/dg/filieres', 'dg/DgController@filieres');
$router->add('/dg/valider_prof', 'dg/DgController@validerProfesseur');
$router->add('/dg/rejeter_prof', 'dg/DgController@rejeterProfesseur');

// =====================================================
// ===== ESPACE PROFESSEUR =====
// =====================================================
$router->add('/professeur/dashboard', 'professeur/ProfesseurController@dashboard');
$router->add('/professeur/logout', 'professeur/ProfesseurController@logout');
$router->add('/professeur/notes', 'professeur/NotesController@index');
$router->add('/professeur/notes/save', 'professeur/NotesController@save');

// =====================================================
// ===== ANCIENNES ROUTES (Compatibilité) =====
// =====================================================
$router->add('/login', 'admin/AuthController@login');
$router->add('/signup', 'admin/AuthController@signup');
$router->add('/logout', 'admin/AuthController@logout');
$router->add('/dashboard', 'admin/DashboardController@index');
$router->add('/dg_dashboard', 'admin/DgController@index');
$router->add('/dg_validate_prof', 'admin/DgController@validateProfesseur');

// =====================================================
// ===== SETUP TEMPORAIRE =====
// =====================================================
$router->add('/setup_users', 'SetupController@index');
$router->add('/setup_users/store', 'SetupController@store');

// =====================================================
// ===== DÉCLENCHEMENT DE LA ROUTE =====
// =====================================================
// ===== DÉCLENCHEMENT DE LA ROUTE =====
// =====================================================
// On récupère l'URL nettoyée (sans les paramètres de recherche après le "?")
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($url);