<?php

require_once ROOT_PATH . '/app/models/Admin.php';
require_once ROOT_PATH . '/app/models/Professeur.php';

/**
 * PersonnelAuthController
 * Gère la connexion pour les 3 types de personnel :
 *   - Secrétaire (role = secretaire)
 *   - Directeur Général (role = dg)
 *   - Professeur (table professeurs, accord_dg = 1)
 */
class PersonnelAuthController extends Controller
{
    public function login()
    {
        // Si déjà connecté, redirige
        if (isset($_SESSION['admin_id']) || isset($_SESSION['prof_id'])) {
            header('Location: /');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $data['error'] = "Veuillez remplir tous les champs.";
                $this->view('personnel/login', $data);
                return;
            }

            // 1. Vérifie d'abord dans la table administrateurs (Secrétaire / DG)
            $adminModel = new Admin();
            $admin = $adminModel->findByEmail($email);
            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_id']     = $admin['id'];
                $_SESSION['admin_email']  = $admin['email'];
                $_SESSION['admin_pseudo'] = $admin['pseudo'];
                $_SESSION['admin_role']   = $admin['role'];
                $_SESSION['snackbar']     = "Connexion réussie. Bienvenue " . $admin['pseudo'] . " !";

                if ($admin['role'] === 'dg') {
                    header('Location: /dg/dashboard');
                } else {
                    header('Location: /secretaire/dashboard');
                }
                exit();
            }

            // 2. Vérifie dans la table professeurs
            $profModel = new Professeur();
            $prof = $profModel->findByEmail($email);
            if ($prof) {
                if (!$prof['password']) {
                    $data['error'] = "Votre compte n'est pas encore activé. Attendez la validation du DG.";
                    $this->view('personnel/login', $data);
                    return;
                }
                if ($prof['accord_dg'] != 1) {
                    $data['error'] = "Votre poste n'a pas encore été validé par la Direction.";
                    $this->view('personnel/login', $data);
                    return;
                }
                if (password_verify($password, $prof['password'])) {
                    $_SESSION['prof_id']        = $prof['id'];
                    $_SESSION['prof_email']     = $prof['email'];
                    $_SESSION['prof_nom']       = $prof['nom'] . ' ' . $prof['prenom'];
                    $_SESSION['prof_specialite']= $prof['specialite'];
                    $_SESSION['snackbar']       = "Bienvenue Prof. " . $prof['nom'] . " !";
                    header('Location: /professeur/dashboard');
                    exit();
                }
            }

            // 3. Aucun compte trouvé
            $data['error'] = "Identifiants incorrects. Veuillez réessayer.";
            $this->view('personnel/login', $data);

        } else {
            $this->view('personnel/login');
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header('Location: /');
        exit();
    }
}
