<?php
require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Admin.php';
require_once ROOT_PATH . '/app/models/Filiere.php'; 

class DashboardController extends Controller
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

        $adminModel = $this->model('Admin');
        $etudiantModel = $this->model('Etudiant');

        $listAdmins = $adminModel->getAll();
        $totalAdmins = count($listAdmins);
        $totalEtudiants = $etudiantModel->countAll();

        // Récupère les étudiants avec leur filière via le LEFT JOIN du modèle
        $tousEtudiants = $etudiantModel->getAll();
        $derniersEtudiants = array_slice($tousEtudiants, 0, 5);

        $data = [
            'admin_pseudo'    => $_SESSION['admin_pseudo'] ?? 'Admin',
            'total_etudiants' => $totalEtudiants,
            'total_admins'    => $totalAdmins,
            'list_admins'     => $listAdmins,
            'etudiants'       => $derniersEtudiants,
            'filieres'        => $etudiantModel->getStatsParFiliere() // Stats dynamiques ok
        ];

        // CORRECTION : On pointe vers 'dashboard/index' pour éviter l'erreur Failed opening required
        $this->view('dashboard/index', $data);
    }
}