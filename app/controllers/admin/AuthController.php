<?php

/**
 * ============================================================
 * AUTH CONTROLLER - Gestion de l'authentification
 * ============================================================
 * * Gère : landing, login, signup, logout
 * * ✅ FAIT :
 * - landing()  : affiche la page d'accueil publique
 * - login()    : GET = affiche le formulaire / POST = vérifie email+mdp et connecte
 * - signup()   : GET = affiche le formulaire / POST = crée un nouveau admin en DB
 * - logout()   : détruit la session et redirige vers /
 * * 🔧 À FAIRE (TODO) :
 * - Ajouter la validation des champs (longueur mdp, format email, etc.)
 * - Ajouter la protection CSRF (token dans les formulaires)
 * - Limiter le nombre de tentatives de connexion (brute-force)
 * - Supprimer la route /signup en production (sert uniquement à créer le 1er admin)
 */

// Charge le modèle Admin pour interagir avec la table "administrateurs"
require_once ROOT_PATH . '/app/models/Admin.php';

class AuthController extends Controller
{
    /**
     * Page d'accueil publique (Landing Page)
     * Route : GET /
     */
    public function landing()
    {
        $this->view('landing');
    }

    /**
     * Connexion administrateur
     * Route : GET /login  → affiche le formulaire
     * POST /login → vérifie les identifiants et connecte
     */
    /**
     * Connexion administrateur
     * Route : GET /login  → affiche le formulaire
     * POST /login → vérifie les identifiants et connecte
     */
    public function login()
    {
        // Si l'admin est déjà connecté, on le redirige directement au dashboard
        if (isset($_SESSION['admin_id'])) {
            header('Location: /dashboard');
            exit();
        }

        // Traitement du formulaire de connexion (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (!empty($email) && !empty($password)) {
                $adminModel = new Admin();
                $admin = $adminModel->findByEmail($email);

                // Vérifie que l'admin existe ET que le mot de passe correspond au hash
                if ($admin && password_verify($password, $admin['password'])) {
                    // ✅ Connexion réussie - on crée la session
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_email'] = $admin['email'];
                    $_SESSION['admin_pseudo'] = $admin['pseudo'];
                    $_SESSION['snackbar'] = "Connexion réussie. Bienvenue 👋 !";

                    header('Location: /dashboard');
                    exit();
                } else {
                    // ❌ Identifiants incorrects
                    $data['error'] = "Email ou mot de passe incorrect";
                    $this->view('auth/login', $data);
                }
            } else {
                // ❌ Champs vides
                $data['error'] = "Veuillez remplir tous les champs";
                $this->view('auth/login', $data);
            }
        } else {
            // GET : affiche simplement le formulaire de connexion
            $this->view('auth/login');
        }
    }

    /**
     * Inscription d'un nouvel administrateur
     * Route : GET /signup  → affiche le formulaire
     * POST /signup → crée le compte admin en DB
     */
    public function signup()
    {
        // Si déjà connecté, pas besoin de s'inscrire
        if (isset($_SESSION['admin_id'])) {
            header('Location: /dashboard');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = htmlspecialchars(strip_tags($_POST['pseudo'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if (!empty($pseudo) && !empty($email) && !empty($password)) {
                // Vérifie que les mots de passe correspondent
                if ($password !== $password_confirm) {
                    $data['error'] = "Les mots de passe ne correspondent pas";
                    $this->view('auth/signup', $data);
                    return;
                }

                $adminModel = new Admin();

                // Vérifie que l'email n'est pas déjà utilisé
                $existingAdmin = $adminModel->findByEmail($email);
                if ($existingAdmin) {
                    $data['error'] = "Cet email est déjà utilisé";
                    $this->view('auth/signup', $data);
                    return;
                }

                // Crée le nouvel admin en base de données
                $result = $adminModel->create([
                    'pseudo' => $pseudo,
                    'email' => $email,
                    'password' => $password
                ]);

                if ($result) {
                    // ✅ Redirection propre vers le formulaire de login après inscription
                    header('Location: /login');
                    exit();
                } else {
                    $data['error'] = "Erreur lors de la création du compte";
                    $this->view('auth/signup', $data);
                }
            } else {
                $data['error'] = "Veuillez remplir tous les champs";
                $this->view('auth/signup', $data);
            }
        } else {
            // GET : affiche le formulaire d'inscription
            $this->view('auth/signup');
        }
    }

    /**
     * Déconnexion
     * Route : GET /logout
     */
    public function logout()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params['secure'],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: /");
        exit();
    }
}
