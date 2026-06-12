<?php

// =====================================================
// ===== IMPORTS DES MODÈLES (Centralisés en haut) =====
// =====================================================
require_once ROOT_PATH . '/app/models/Matiere.php';
require_once ROOT_PATH . '/app/models/Filiere.php';
require_once ROOT_PATH . '/app/models/Professeur.php';
require_once ROOT_PATH . '/app/models/Salle.php';
require_once ROOT_PATH . '/app/models/PlanningCours.php';

class CalendrierController extends Controller
{ // <-- Ligne 13 : L'accolade qui était restée ouverte
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login_personnel');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();

        $planningModel = new PlanningCours();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'filiere_id'    => $_POST['filiere_id'],
                'matiere_id'    => $_POST['matiere_id'],
                'professeur_id' => $_POST['professeur_id'],
                'salle_id'      => $_POST['salle_id'],
                'date_cours'    => $_POST['date_cours'],
                'heure_debut'   => $_POST['heure_debut'],
                'heure_fin'     => $_POST['heure_fin'],
                'created_by'    => $_SESSION['admin_id']
            ];

            $result = $planningModel->create($data);

            if ($result['success']) {
                $_SESSION['snackbar'] = $result['message'];
            } else {
                $_SESSION['snackbar_error'] = $result['message'];
            }
            header('Location: /calendrier');
            exit();
        }

        $filiereModel = new Filiere();
        $professeurModel = new Professeur();
        $salleModel = new Salle();

        $data = [
            'admin_pseudo'  => $_SESSION['admin_pseudo'] ?? 'Admin',
            'filieres'      => $filiereModel->getAll(),
            'professeurs'   => $professeurModel->getValidated(),
            'salles'        => $salleModel->getDisponibles(),
            'plannings'     => $planningModel->getAll(),
        ];

        $this->view('secretaire/calendrier', $data);
    }

    public function apiGetMatieres()
    {
        $this->requireAuth();
        header('Content-Type: application/json');
        
        $filiere_id = (int)($_GET['filiere_id'] ?? 0);
        if (!$filiere_id) {
            echo json_encode([]);
            return;
        }

        $matiereModel = new Matiere();
        $matieres = $matiereModel->getByFiliere($filiere_id);
        echo json_encode($matieres);
    }

    public function apiSaveCours()
    {
        $this->requireAuth();
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            echo json_encode(['success' => false, 'error' => 'Données invalides']);
            return;
        }

        $filiere_id = (int)($data['filiere_id'] ?? 0);
        $matiere_id = (int)($data['matiere_id'] ?? 0);
        $professeur_id = (int)($data['professeur_id'] ?? 0);
        $salle_id = (int)($data['salle_id'] ?? 0);
        $date_cours = $data['date_cours'] ?? '';
        $heure_debut = $data['heure_debut'] ?? '';
        $heure_fin = $data['heure_fin'] ?? '';

        if (!$filiere_id || !$matiere_id || !$professeur_id || !$salle_id || empty($date_cours) || empty($heure_debut) || empty($heure_fin)) {
            echo json_encode(['success' => false, 'error' => 'Veuillez remplir tous les champs obligatoires.']);
            return;
        }

        $insertData = [
            'filiere_id'    => $filiere_id,
            'matiere_id'    => $matiere_id,
            'professeur_id' => $professeur_id,
            'salle_id'      => $salle_id,
            'date_cours'    => $date_cours,
            'heure_debut'   => $heure_debut,
            'heure_fin'     => $heure_fin,
            'created_by'    => $_SESSION['admin_id']
        ];

        $planningModel = new PlanningCours();
        $result = $planningModel->create($insertData);

        if ($result['success']) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $result['message'] ?? 'Conflit détecté ou erreur lors de la sauvegarde.']);
        }
    } // <-- Ferme apiSaveCours
} // <-- AJOUTÉE ICI : Ferme la classe CalendrierController