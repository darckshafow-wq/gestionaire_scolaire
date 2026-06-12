<?php

require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Admin.php';
require_once ROOT_PATH . '/app/models/Filiere.php';
require_once ROOT_PATH . '/app/models/Professeur.php';
require_once ROOT_PATH . '/app/models/Salle.php';
require_once ROOT_PATH . '/app/models/PlanningCours.php';

class SecretaireController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'secretaire') {
            header('Location: /login_personnel');
            exit();
        }
    }

    public function dashboard()
    {
        $this->requireAuth();

        $etudiantModel   = new Etudiant();
        $filiereModel    = new Filiere();
        $professeurModel = new Professeur();

        $allEtudiants = $etudiantModel->getAll();
        $enAttente    = array_filter($allEtudiants, fn($e) => $e['statut'] === 'en attente');

        $data = [
            'admin_pseudo'     => $_SESSION['admin_pseudo'] ?? 'Secrétaire',
            'total_etudiants'  => count($allEtudiants),
            'dossiers_attente' => count($enAttente),
            'total_filieres'   => count($filiereModel->getAll()),
            'total_profs'      => count($professeurModel->getAll()),
            'derniers_dossiers'=> array_slice(array_values($enAttente), 0, 5),
        ];

        $this->view('secretaire/dashboard', $data);
    }

    public function dossiers()
    {
        $this->requireAuth();

        $etudiantModel = new Etudiant();
        $enAttente = array_filter($etudiantModel->getAll(), fn($e) => $e['statut'] === 'en attente');

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Secrétaire',
            'dossiers'     => array_values($enAttente),
        ];

        $this->view('secretaire/dossiers', $data);
    }

    public function validerDossier()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id              = (int)($_POST['id'] ?? 0);
            $action          = $_POST['action'] ?? 'accepter'; // 'accepter' ou 'rejeter'

            if ($id) {
                $etudiantModel = new Etudiant();
                $etudiant      = $etudiantModel->getById($id);

                if ($action === 'accepter' && $etudiant) {
                    // Génère un mot de passe temporaire
                    $temp_password = 'epi' . rand(1000, 9999);
                    $hash          = password_hash($temp_password, PASSWORD_BCRYPT);
                    $etudiantModel->validerInscription($id, $hash);
                    $_SESSION['snackbar'] = "Dossier de {$etudiant['nom']} validé. Mot de passe provisoire : <strong>$temp_password</strong>";
                } else {
                    $etudiantModel->updateStatutInscription($id, 'rejeté');
                    $_SESSION['snackbar_error'] = "Dossier rejeté.";
                }
            }
        }

        header('Location: /secretaire/dossiers');
        exit();
    }

    public function candidaturesProfesseur()
    {
        $this->requireAuth();

        $profModel = new Professeur();
        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Secrétaire',
            'candidatures' => $profModel->getCandidatures(),
        ];

        $this->view('secretaire/candidatures_professeur', $data);
    }
}
