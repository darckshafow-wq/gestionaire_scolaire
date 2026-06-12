<?php

require_once ROOT_PATH . '/app/models/Professeur.php';
require_once ROOT_PATH . '/app/models/Admin.php';
require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Filiere.php';

class DgController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'dg') {
            header('Location: /login_personnel');
            exit();
        }
    }

    /** Tableau de bord global : statistiques */
    public function dashboard()
    {
        $this->requireAuth();

        $profModel     = new Professeur();
        $etudiantModel = new Etudiant();
        $filiereModel  = new Filiere();

        $professeurs   = $profModel->getAll();
        $filieres      = $filiereModel->getAll();

        $data = [
            'admin_pseudo'    => $_SESSION['admin_pseudo'] ?? 'DG',
            'total_etudiants' => $etudiantModel->countAll(),
            'total_filieres'  => count($filieres),
            'prof_valides'    => count(array_filter($professeurs, fn($p) => $p['accord_dg'] == 1)),
            'prof_en_attente' => count(array_filter($professeurs, fn($p) => $p['accord_dg'] == 0)),
            'filieres'        => $filieres,
        ];

        $this->view('dg/dashboard', $data);
    }

    /** Page : gestion des professeurs (candidats + personnel) */
    public function professeurs()
    {
        $this->requireAuth();

        $profModel = new Professeur();
        $tous      = $profModel->getAll();

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'DG',
            // Candidats : pas encore dans l'école (accord_dg = 0)
            'candidats'    => array_values(array_filter($tous, fn($p) => $p['accord_dg'] == 0)),
            // Personnel : professeurs validés par le DG (accord_dg = 1)
            'personnel'    => array_values(array_filter($tous, fn($p) => $p['accord_dg'] == 1)),
        ];

        $this->view('dg/professeurs', $data);
    }

    /** Page : liste des filières */
    public function filieres()
    {
        $this->requireAuth();

        $filiereModel = new Filiere();

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'DG',
            'filieres'     => $filiereModel->getAll(),
        ];

        $this->view('dg/filieres', $data);
    }

    /** Action : Valider un professeur → il devient personnel de l'école */
    public function validerProfesseur()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $temp_password = 'prof' . rand(1000, 9999);
                $hash = password_hash($temp_password, PASSWORD_BCRYPT);

                $profModel = new Professeur();
                if ($profModel->validateWithPassword($id, $hash)) {
                    $_SESSION['snackbar'] = "Professeur admis ! Mot de passe provisoire : <strong>$temp_password</strong> (à communiquer).";
                } else {
                    $_SESSION['snackbar_error'] = "Erreur lors de la validation.";
                }
            }
        }

        header('Location: /dg/professeurs');
        exit();
    }

    /** Action : Rejeter un candidat professeur */
    public function rejeterProfesseur()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $profModel = new Professeur();
                if ($profModel->delete($id)) {
                    $_SESSION['snackbar'] = "Candidature refusée et supprimée.";
                }
            }
        }

        header('Location: /dg/professeurs');
        exit();
    }
}
