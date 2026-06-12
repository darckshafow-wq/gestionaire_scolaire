<?php

require_once ROOT_PATH . '/app/models/Salle.php';

class SallesController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'secretaire') {
            header('Location: /login_personnel');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();

        $salleModel = new Salle();
        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Secrétaire',
            'salles'       => $salleModel->getAll(),
        ];

        $this->view('secretaire/salles', $data);
    }

    public function create()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom      = htmlspecialchars(trim($_POST['nom'] ?? ''));
            $capacite = (int)($_POST['capacite'] ?? 30);
            $etat     = $_POST['etat_dispo'] ?? 'Disponible';

            if (!empty($nom) && $capacite > 0) {
                $salleModel = new Salle();
                if ($salleModel->create($nom, $capacite, $etat)) {
                    $_SESSION['snackbar'] = "Salle '$nom' ajoutée avec succès.";
                } else {
                    $_SESSION['snackbar_error'] = "Erreur lors de l'ajout de la salle (le nom existe peut-être déjà).";
                }
            } else {
                $_SESSION['snackbar_error'] = "Données invalides.";
            }
        }

        header('Location: /salles');
        exit();
    }

    public function updateEtat()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id   = (int)($_POST['id'] ?? 0);
            $etat = $_POST['etat_dispo'] ?? '';

            if ($id && in_array($etat, ['Disponible', 'Indisponible', 'En maintenance'])) {
                $salleModel = new Salle();
                if ($salleModel->updateEtat($id, $etat)) {
                    $_SESSION['snackbar'] = "État de la salle mis à jour.";
                }
            }
        }

        header('Location: /salles');
        exit();
    }

    public function delete()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $salleModel = new Salle();
                if ($salleModel->delete($id)) {
                    $_SESSION['snackbar'] = "Salle supprimée avec succès.";
                } else {
                    $_SESSION['snackbar_error'] = "Impossible de supprimer cette salle (elle est peut-être utilisée dans l'emploi du temps).";
                }
            }
        }

        header('Location: /salles');
        exit();
    }
}
