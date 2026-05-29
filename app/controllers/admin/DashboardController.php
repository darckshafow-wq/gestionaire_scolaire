<?php
/**
 * TODO:
 * - Intégrer une librairie JS (ex: FullCalendar) pour la page calendrier
 * - Gérer la sauvegarde des paramètres en BDD
 * - Ajouter un middleware pour vérifier $_SESSION['admin_id'] sur toutes les routes dashboard
 * - Brancher le StudentController complet
 */

require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Admin.php';

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
        $tousEtudiants = $etudiantModel->getAll();

        $derniersEtudiants = array_slice($tousEtudiants, 0, 5);

        $data = [
            'admin_pseudo'    => $_SESSION['admin_pseudo'] ?? 'Admin',
            'total_etudiants' => $totalEtudiants,
            'total_admins'    => $totalAdmins,
            'list_admins'     => $listAdmins,
            'etudiants'       => $derniersEtudiants
        ];

        $this->view('dashboard/index', $data);
    }

}
