<?php
require_once ROOT_PATH . '/app/models/Etudiant.php';

class EtudiantDetailController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();
        
        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
            'etudiant'     => null
        ];

        // Sécurisation stricte de l'ID reçu en GET
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $etudiantModel = $this->model('Etudiant');
            
            // IMPORTANT : getById() doit retourner les infos de la filière !
            $etudiant = $etudiantModel->getById($id);

            if ($etudiant) {
                $data['etudiant'] = $etudiant;
                
                // Appel de la vue corrigée
                $this->view('dashboard/etudiant_detail', $data);
                return;
            }
        }

        // Si l'étudiant n'existe pas ou ID incorrect
        $_SESSION['snackbar'] = "Erreur : Étudiant introuvable ou ID invalide.";
        header('Location: /etudiants');
        exit();
    }
}