<?php
require_once ROOT_PATH . '/app/models/Etudiant.php';

class InscriptionController extends Controller
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
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $etudiantModel = $this->model('Etudiant');

            $inputs = [
                'nom'            => $_POST['nom'] ?? '',
                'prenom'         => $_POST['prenom'] ?? '',
                'email'          => $_POST['email'] ?? '',
                'tuteur_nom'     => $_POST['tuteur_nom'] ?? '',
                'tuteur_contact' => $_POST['tuteur_contact'] ?? '',
                'date_naissance' => $_POST['date_naissance'] ?? '',
                'annee_scolaire' => $_POST['annee_scolaire'] ?? '',
                'created_by'     => $_SESSION['admin_id'] ?? 1
            ];

            if (!empty($inputs['nom']) && !empty($inputs['prenom']) && !empty($inputs['date_naissance']) && !empty($inputs['annee_scolaire']) && !empty($inputs['tuteur_nom']) && !empty($inputs['tuteur_contact'])) {
                $result = $etudiantModel->create($inputs);

                if ($result) {
                    $_SESSION['snackbar'] = "Nouvel étudiant inscrit avec succès !";
                    header('Location: /etudiants');
                    exit();
                } else {
                    $data['error'] = "Erreur lors de l'inscription en base de données.";
                }
            } else {
                $data['error'] = "Veuillez remplir tous les champs obligatoires.";
            }
        }

        $this->view('dashboard/inscriptions', $data);
    }
}
