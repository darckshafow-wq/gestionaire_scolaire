<?php

require_once ROOT_PATH . '/app/models/Professeur.php';
require_once ROOT_PATH . '/app/models/Admin.php';

class DgController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'dg') {
            header('Location: /dashboard');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();

        $professeurModel = new Professeur();
        $adminModel = new Admin();

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'DG',
            'professeurs'  => $professeurModel->getAll(),
            'total_admins' => $adminModel->countAll(),
        ];

        $this->view('dashboard/dg', $data);
    }

    public function validateProfesseur()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $professeurModel = new Professeur();
                if ($professeurModel->validate($id)) {
                    $_SESSION['snackbar'] = "Professeur validé avec succès.";
                } else {
                    $_SESSION['snackbar_error'] = "Erreur lors de la validation.";
                }
            }
        }
        header('Location: /dg_dashboard');
        exit();
    }
}
