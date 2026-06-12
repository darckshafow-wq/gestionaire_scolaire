<?php

require_once ROOT_PATH . '/app/models/Admin.php';
require_once ROOT_PATH . '/app/models/Professeur.php';

class SetupController extends Controller
{
    public function index()
    {
        $this->view('setup/users');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /setup_users');
            exit();
        }

        $role = $_POST['role'] ?? '';
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($role) || empty($nom) || empty($email) || empty($password)) {
            $_SESSION['setup_error'] = "Veuillez remplir tous les champs obligatoires.";
            header('Location: /setup_users');
            exit();
        }

        try {
            if ($role === 'dg' || $role === 'secretaire') {
                $adminModel = new Admin();
                // Admin model 'create' expects 'pseudo' and hashes the password itself.
                $adminModel->create([
                    'pseudo' => $nom,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role
                ]);
            } else if ($role === 'professeur') {
                $profModel = new Professeur();
                $specialite = trim($_POST['specialite'] ?? 'Général');
                
                // Split nom into nom and prenom just for the sake of the model
                $parts = explode(' ', $nom, 2);
                $nom_prof = $parts[0];
                $prenom_prof = $parts[1] ?? '';

                // We use create first, which inserts with accord_dg = 0
                $profModel->create([
                    'nom' => $nom_prof,
                    'prenom' => $prenom_prof,
                    'email' => $email,
                    'telephone' => 'N/A',
                    'specialite' => $specialite
                ]);

                // Then we find it and validate with password
                $prof = $profModel->findByEmail($email);
                if ($prof) {
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $profModel->validateWithPassword($prof['id'], $password_hash);
                }
            }

            $_SESSION['setup_success'] = "L'utilisateur ($role) a été créé avec succès.";
            header('Location: /setup_users');
            exit();

        } catch (Exception $e) {
            $_SESSION['setup_error'] = "Erreur lors de la création : " . $e->getMessage();
            header('Location: /setup_users');
            exit();
        }
    }
}
