<?php

require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Filiere.php';
require_once ROOT_PATH . '/app/models/PlanningCours.php';

class EtudiantController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['etudiant_id'])) {
            header('Location: /etudiant/login');
            exit();
        }
    }

    public function portail()
    {
        $this->view('etudiant/portail');
    }

    public function login()
    {
        if (isset($_SESSION['etudiant_id'])) {
            header('Location: /etudiant/dashboard');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $data['error'] = "Veuillez remplir tous les champs.";
                $this->view('etudiant/login', $data);
                return;
            }

            $etudiantModel = new Etudiant();
            $etudiant = $etudiantModel->findByEmail($email);

            if (!$etudiant) {
                $data['error'] = "Aucun compte trouvé avec cet email.";
                $this->view('etudiant/login', $data);
                return;
            }
            if ($etudiant['statut'] === 'en attente') {
                $data['error'] = "Votre dossier est encore en cours d'examen. Attendez la validation du secrétariat.";
                $this->view('etudiant/login', $data);
                return;
            }
            if (!$etudiant['password'] || !password_verify($password, $etudiant['password'])) {
                $data['error'] = "Mot de passe incorrect.";
                $this->view('etudiant/login', $data);
                return;
            }

            $_SESSION['etudiant_id']        = $etudiant['id'];
            $_SESSION['etudiant_nom']       = $etudiant['nom'];
            $_SESSION['etudiant_filiere_id']= $etudiant['filiere_id'];
            header('Location: /etudiant/dashboard');
            exit();

        } else {
            $this->view('etudiant/login');
        }
    }

    public function inscription()
    {
        $filiereModel = new Filiere();
        $data['filieres'] = $filiereModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom             = htmlspecialchars(trim($_POST['nom'] ?? ''));
            $prenom          = htmlspecialchars(trim($_POST['prenom'] ?? ''));
            $email           = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $date_naissance  = $_POST['date_naissance'] ?? '';
            $annee_scolaire  = htmlspecialchars(trim($_POST['annee_scolaire'] ?? ''));
            $filiere_id      = (int)($_POST['filiere_id'] ?? 0);
            $tuteur_nom      = htmlspecialchars(trim($_POST['tuteur_nom'] ?? ''));
            $tuteur_contact  = htmlspecialchars(trim($_POST['tuteur_contact'] ?? ''));

            if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($filiere_id)) {
                $data['error'] = "Veuillez remplir tous les champs obligatoires.";
                $this->view('etudiant/inscription', $data);
                return;
            }

            $photo_url    = null;
            $document_url = null;
            $upload_dir   = ROOT_PATH . '/public/uploads/dossiers/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Upload photo
            if (!empty($_FILES['photo_file']['tmp_name'])) {
                $ext = pathinfo($_FILES['photo_file']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('photo_') . '.' . $ext;
                move_uploaded_file($_FILES['photo_file']['tmp_name'], $upload_dir . $filename);
                $photo_url = '/uploads/dossiers/' . $filename;
            }

            // Upload document PDF
            if (!empty($_FILES['document_file']['tmp_name'])) {
                $ext = pathinfo($_FILES['document_file']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('doc_') . '.' . $ext;
                move_uploaded_file($_FILES['document_file']['tmp_name'], $upload_dir . $filename);
                $document_url = '/uploads/dossiers/' . $filename;
            }

            $etudiantModel = new Etudiant();
            $etudiantModel->create([
                'nom'           => $nom,
                'prenom'        => $prenom,
                'email'         => $email ?: null,
                'date_naissance'=> $date_naissance,
                'annee_scolaire'=> $annee_scolaire,
                'filiere_id'    => $filiere_id,
                'tuteur_nom'    => $tuteur_nom,
                'tuteur_contact'=> $tuteur_contact,
                'statut'        => 'en attente',
                'photo_url'     => $photo_url,
                'document_url'  => $document_url,
                'created_by'    => null
            ]);

            $data['success'] = true;
            $this->view('etudiant/inscription', $data);
            return;
        }

        $this->view('etudiant/inscription', $data);
    }

    public function dashboard()
    {
        $this->requireAuth();

        $etudiantModel = new Etudiant();
        $etudiant = $etudiantModel->getById($_SESSION['etudiant_id']);

        $planningModel = new PlanningCours();
        $allPlannings  = $planningModel->getAll();
        $plannings = array_filter($allPlannings, function($p) use ($etudiant) {
            return $p['filiere_id'] == $etudiant['filiere_id'];
        });

        $data = [
            'etudiant' => $etudiant,
            'plannings'=> array_values($plannings)
        ];

        $this->view('etudiant/dashboard', $data);
    }

    public function logout()
    {
        unset($_SESSION['etudiant_id']);
        unset($_SESSION['etudiant_nom']);
        unset($_SESSION['etudiant_filiere_id']);
        session_destroy();
        header('Location: /portail_etudiant');
        exit();
    }
}
