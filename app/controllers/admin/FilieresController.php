<?php

require_once ROOT_PATH . '/app/models/Filiere.php';

class FilieresController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login');
            exit();
        }
    }

    /**
     * Liste de toutes les filières
     * GET /filieres
     */
    public function index()
    {
        $this->requireAuth();

        $filiereModel = new Filiere();
        $filieres = $filiereModel->getAll();

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
            'filieres'     => $filieres,
        ];

        $this->view('dashboard/filieres', $data);
    }

    /**
     * Créer une nouvelle filière
     * POST /filieres/create
     */
    public function create()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /filieres');
            exit();
        }

        $filiereModel = new Filiere();
        $code = strtoupper(trim($_POST['code'] ?? ''));

        if (empty($code) || empty($_POST['nom'])) {
            $_SESSION['snackbar_error'] = "Le code et le nom sont obligatoires.";
            header('Location: /filieres');
            exit();
        }

        if ($filiereModel->codeExists($code)) {
            $_SESSION['snackbar_error'] = "Ce code filière existe déjà : $code";
            header('Location: /filieres');
            exit();
        }

        $result = $filiereModel->create([
            'code'         => $code,
            'nom'          => $_POST['nom'] ?? '',
            'description'  => $_POST['description'] ?? '',
            'duree_annees' => $_POST['duree_annees'] ?? 3,
            'niveau'       => $_POST['niveau'] ?? 'Licence',
            'statut'       => $_POST['statut'] ?? 'Active',
        ]);

        if ($result) {
            $_SESSION['snackbar'] = "Filière « {$_POST['nom']} » créée avec succès !";
        } else {
            $_SESSION['snackbar_error'] = "Erreur lors de la création de la filière.";
        }

        header('Location: /filieres');
        exit();
    }

    /**
     * Détail + formulaire de modification
     * GET  /filiere_detail?id=X
     * POST /filiere_detail?id=X  → mise à jour
     */
    public function detail()
    {
        $this->requireAuth();

        $id = (int)($_GET['id'] ?? 0);
        if (!$id) {
            header('Location: /filieres');
            exit();
        }

        $filiereModel = new Filiere();
        $filiere = $filiereModel->getById($id);

        if (!$filiere) {
            header('Location: /filieres');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = strtoupper(trim($_POST['code'] ?? ''));

            if (empty($code) || empty($_POST['nom'])) {
                $data = [
                    'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
                    'filiere'      => $filiere,
                    'error'        => "Le code et le nom sont obligatoires.",
                ];
                $this->view('dashboard/filiere_detail', $data);
                return;
            }

            if ($filiereModel->codeExists($code, $id)) {
                $data = [
                    'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
                    'filiere'      => array_merge($filiere, $_POST),
                    'error'        => "Ce code filière est déjà utilisé par une autre filière.",
                ];
                $this->view('dashboard/filiere_detail', $data);
                return;
            }

            $result = $filiereModel->update($id, [
                'code'         => $code,
                'nom'          => $_POST['nom'] ?? '',
                'description'  => $_POST['description'] ?? '',
                'duree_annees' => $_POST['duree_annees'] ?? 3,
                'niveau'       => $_POST['niveau'] ?? 'Licence',
                'statut'       => $_POST['statut'] ?? 'Active',
            ]);

            if ($result) {
                $_SESSION['snackbar'] = "Filière mise à jour avec succès !";
                header('Location: /filiere_detail?id=' . $id);
                exit();
            } else {
                $data = [
                    'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
                    'filiere'      => $filiere,
                    'error'        => "Erreur lors de la mise à jour.",
                ];
                $this->view('dashboard/filiere_detail', $data);
                return;
            }
        }

        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
            'filiere'      => $filiere,
        ];

        $this->view('dashboard/filiere_detail', $data);
    }

    /**
     * Supprimer une filière
     * POST /filiere_delete
     */
    public function delete()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /filieres');
            exit();
        }

        $id = (int)($_POST['id'] ?? 0);
        if (!$id) {
            header('Location: /filieres');
            exit();
        }

        $filiereModel = new Filiere();
        $filiere = $filiereModel->getById($id);

        if ($filiere && $filiereModel->delete($id)) {
            $_SESSION['snackbar'] = "Filière « {$filiere['nom']} » supprimée.";
        } else {
            $_SESSION['snackbar_error'] = "Impossible de supprimer cette filière.";
        }

        header('Location: /filieres');
        exit();
    }
}
