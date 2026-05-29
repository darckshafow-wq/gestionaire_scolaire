<?php
require_once ROOT_PATH . '/app/models/Etudiant.php';

class EtudiantsController extends Controller
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

        $etudiantModel = $this->model('Etudiant');

        $search = trim($_GET['search'] ?? '');

        if (!empty($search)) {
            $etudiants = $etudiantModel->search($search);
        } else {
            $etudiants = $etudiantModel->getAll();
        }

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
            'etudiants'    => $etudiants,
        ];

        $this->view('dashboard/etudiants', $data);
    }
}
