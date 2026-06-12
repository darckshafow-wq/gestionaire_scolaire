<?php

require_once ROOT_PATH . '/app/models/Matiere.php';

class MatieresController extends Controller
{
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
        require_once ROOT_PATH . '/app/models/Filiere.php';

        $matiereModel = new Matiere();
        $filiereModel = new Filiere();

        // On peut récupérer toutes les matières de la BDD.
        // Comme Matiere model n'a pas getAll() on va devoir utiliser getAllByFiliere pour chaque ou rajouter getAll()
        // On va vérifier si getAll() existe. Si non, on ajoute dans le model.
        // Plus simple: on récupère les filières, puis on récupère les matières.
        $filieres = $filiereModel->getAll();
        
        $matieres_groupees = [];
        foreach ($filieres as $f) {
            $mat = $matiereModel->getByFiliere($f['id']);
            if (!empty($mat)) {
                $matieres_groupees[$f['nom']] = [
                    'filiere_id' => $f['id'],
                    'matieres' => $mat
                ];
            }
        }

        $admin_pseudo = $_SESSION['admin_pseudo'] ?? 'Secrétaire';
        require ROOT_PATH . '/app/views/secretaire/matieres.php';
    }

    public function create()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /filieres');
            exit();
        }

        $matiereModel = new Matiere();
        $filiere_id = (int)($_POST['filiere_id'] ?? 0);
        $nom = trim($_POST['nom'] ?? '');
        $volume_horaire = (int)($_POST['volume_horaire'] ?? 20);
        $coefficient = (int)($_POST['coefficient'] ?? 1);

        if ($filiere_id && !empty($nom)) {
            if ($matiereModel->create($filiere_id, $nom, $volume_horaire, $coefficient)) {
                $_SESSION['snackbar'] = "Matière ajoutée avec succès.";
            } else {
                $_SESSION['snackbar_error'] = "Erreur lors de l'ajout de la matière.";
            }
        } else {
            $_SESSION['snackbar_error'] = "Le nom de la matière est requis.";
        }

        header('Location: /matieres');
        exit();
    }

    public function delete()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /filieres');
            exit();
        }

        $id = (int)($_POST['id'] ?? 0);
        $filiere_id = (int)($_POST['filiere_id'] ?? 0);

        if ($id) {
            $matiereModel = new Matiere();
            if ($matiereModel->delete($id)) {
                $_SESSION['snackbar'] = "Matière supprimée.";
            } else {
                $_SESSION['snackbar_error'] = "Impossible de supprimer la matière.";
            }
        }

        header('Location: /matieres');
        exit();
    }
}
