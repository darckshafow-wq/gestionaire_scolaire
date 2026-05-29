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
        $data['etudiants'] = $etudiantModel->getAll();

        $this->view('dashboard/etudiants', $data);
    }
}
