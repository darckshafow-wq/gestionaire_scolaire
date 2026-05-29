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

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $etudiantModel = $this->model('Etudiant');
            $etudiant = $etudiantModel->getById($id);

            if ($etudiant) {
                $data['etudiant'] = $etudiant;
                $this->view('dashboard/etudiant_detail', $data);
                return;
            }
        }

        header('Location: /etudiants');
        exit();
    }
}
