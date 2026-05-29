<?php
require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Filiere.php'; 

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
        
        $etudiantModel = $this->model('Etudiant');
        $filiereModel  = $this->model('Filiere');

        // Initialisation par défaut des données envoyées à la vue
        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
            'error'        => null,
            'filieres'     => [],
            // On prépare des variables vides pour le formulaire (évite les cases vides après une erreur)
            'inputs'       => [
                'nom'            => '',
                'prenom'         => '',
                'email'          => '',
                'annee_scolaire' => '2026-2027', // Ta valeur par défaut
                'date_naissance' => '',
                'filiere_id'     => '',
                'tuteur_nom'     => '',
                'tuteur_contact' => ''
            ]
        ];

        // Traitement de la soumission du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nettoyage et récupération des inputs
            $data['inputs'] = [
                'nom'            => trim($_POST['nom'] ?? ''),
                'prenom'         => trim($_POST['prenom'] ?? ''),
                'email'          => trim($_POST['email'] ?? ''),
                'tuteur_nom'     => trim($_POST['tuteur_nom'] ?? ''),
                'tuteur_contact' => trim($_POST['tuteur_contact'] ?? ''),
                'date_naissance' => $_POST['date_naissance'] ?? '',
                'annee_scolaire' => trim($_POST['annee_scolaire'] ?? ''),
                'filiere_id'     => $_POST['filiere_id'] ?? '', 
                'created_by'     => $_SESSION['admin_id'] ?? null
            ];

            // Vérification stricte des champs obligatoires (y compris la filière)
            if (
                !empty($data['inputs']['nom']) && 
                !empty($data['inputs']['prenom']) && 
                !empty($data['inputs']['date_naissance']) && 
                !empty($data['inputs']['annee_scolaire']) && 
                !empty($data['inputs']['filiere_id']) && 
                !empty($data['inputs']['tuteur_nom']) && 
                !empty($data['inputs']['tuteur_contact'])
            ) {
                
                // Insertion en base de données via le modèle
                $result = $etudiantModel->create($data['inputs']);

                if ($result) {
                    $_SESSION['snackbar'] = "Nouvel étudiant inscrit avec succès !";
                    header('Location: /etudiants');
                    exit();
                } else {
                    $data['error'] = "Une erreur est survenue lors de l'inscription en base de données.";
                }
            } else {
                $data['error'] = "Veuillez remplir tous les champs obligatoires (y compris la filière).";
            }
        }

        // On charge TOUJOURS les filières pour alimenter le <select>
        $data['filieres'] = $filiereModel->getAll();

        // On envoie le tout à la vue
        $this->view('dashboard/inscriptions', $data);
    }
}