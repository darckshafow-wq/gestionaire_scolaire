<?php

/**
 * ============================================================
 * DASHBOARD CONTROLLER - Tableau de bord et sous-pages
 * ============================================================
 * * Gère toutes les pages du dashboard administrateur.
 * Chaque méthode vérifie la session avant d'afficher la page.
 * * ✅ FAIT :
 * - index()          : Dashboard principal avec stats réelles depuis la DB
 * - etudiants()      : Liste dynamique des étudiants depuis la DB
 * - inscriptions()   : Affiche le formulaire & gère l'inscription (POST) via Etudiant::create()
 * - calendrier()     : Page calendrier (placeholder)
 * - parametres()     : Page paramètres système (vue statique)
 * - etudiantDetail() : Récupère et affiche un étudiant par son ID (?id=XX)
 * - Protection de session via requireAuth()
 */

// Charge les modèles nécessaires
require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Admin.php';

class DashboardController extends Controller
{
    /**
     * Vérifie que l'admin est connecté.
     * Si non connecté → redirige vers /login
     */
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login');
            exit();
        }
    }

    /**
     * Dashboard principal - Page d'accueil après connexion
     * Route : GET /dashboard
     */
    public function index()
    {
        $this->requireAuth();

        // Chargement des modèles
        $adminModel = $this->model('Admin');
        $etudiantModel = $this->model('Etudiant');

        // Récupération des statistiques réelles pour les admins
        $listAdmins = $adminModel->getAll();
        $totalAdmins = count($listAdmins);

        // Récupération des statistiques réelles pour les étudiants ✅
        $totalEtudiants = $etudiantModel->countAll();
        $tousEtudiants = $etudiantModel->getAll();

        // On prend les 5 derniers étudiants de la liste pour l'affichage du tableau récent
        $derniersEtudiants = array_slice($tousEtudiants, 0, 5);

        // Envoi des données réelles à la vue
        $data = [
            'admin_pseudo'    => $_SESSION['admin_pseudo'] ?? 'Admin',
            'total_etudiants' => $totalEtudiants,
            'total_admins'    => $totalAdmins,
            'list_admins'     => $listAdmins,
            'etudiants'       => $derniersEtudiants
        ];

        $this->view('dashboard/index', $data);
    }

    /**
     * Liste des étudiants
     * Route : GET /etudiants
     */
    public function etudiants()
    {
        $this->requireAuth();

        $etudiantModel = $this->model('Etudiant');
        $data['etudiants'] = $etudiantModel->getAll(); // ✅ Chargement dynamique

        $this->view('dashboard/etudiants', $data);
    }

    /**
     * Formulaire d'inscription d'un nouvel étudiant
     * Route : GET /inscriptions  → affiche le formulaire
     * POST /inscriptions → enregistre l'étudiant
     */
    public function inscriptions()
    {
        $this->requireAuth();
        $data = [];

        // Traitement du formulaire d'inscription (POST) ✅
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $etudiantModel = $this->model('Etudiant');

            // Collecte et validation rapide des champs requis
            $inputs = [
                'nom'       => $_POST['nom'] ?? '',
                'prenom'    => $_POST['prenom'] ?? '',
                'email'     => $_POST['email'] ?? '',
                'matricule' => $_POST['matricule'] ?? '',
                'tuteur_nom' => $_POST['tuteur_nom'] ?? '',
                'tuteur_contact' => $_POST['tuteur_contact'] ?? '',
                'date_naissance' => $_POST['date_naissance'] ?? '',
                'annee_scolaire' => $_POST['annee_scolaire'] ?? ''
            ];

            if (!empty($inputs['nom']) && !empty($inputs['prenom']) && !empty($inputs['email']) && !empty($inputs['matricule'])) {
                $result = $etudiantModel->create($inputs);

                if ($result) {
                    // Inscription réussie -> Redirection vers la liste globale
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

    /**
     * Calendrier scolaire
     * Route : GET /calendrier
     */
    public function calendrier()
    {
        $this->requireAuth();
        $this->view('dashboard/calendrier');
    }

    /**
     * Paramètres du système
     * Route : GET /parametres
     */
    public function parametres()
    {
        $this->requireAuth();
        $this->view('dashboard/parametres');
    }

    /**
     * Détail d'un étudiant
     * Route : GET /etudiant_detail?id=XX
     */
    public function etudiantDetail()
    {
        $this->requireAuth();

        // Récupération sécurisée de l'ID passé en paramètre d'URL
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

        // Si l'ID est invalide ou l'étudiant introuvable, retour à la liste avec sécurité
        header('Location: /etudiants');
        exit();
    }
}
