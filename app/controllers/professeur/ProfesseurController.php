<?php

require_once ROOT_PATH . '/app/models/Professeur.php';
require_once ROOT_PATH . '/app/models/PlanningCours.php';
require_once ROOT_PATH . '/app/models/Matiere.php';

class ProfesseurController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['prof_id'])) {
            header('Location: /login_personnel');
            exit();
        }
    }

    public function dashboard()
    {
        $this->requireAuth();

        $planningModel = new PlanningCours();
        $allPlannings  = $planningModel->getAll();

        // Filtrer uniquement les cours de ce professeur
        $mesCours = array_filter($allPlannings, function($p) {
            return $p['professeur_id'] == $_SESSION['prof_id'];
        });

        // Extraire les filières où le prof enseigne
        $filieres_uniques = [];
        foreach ($mesCours as $c) {
            $filieres_uniques[$c['filiere_id']] = $c['filiere_nom'];
        }

        // Prochain cours (date la plus proche dans le futur)
        $prochain_cours = null;
        $today = date('Y-m-d H:i:s');
        foreach ($mesCours as $c) {
            $cours_datetime = $c['date_cours'] . ' ' . $c['heure_debut'];
            if ($cours_datetime >= $today) {
                if (!$prochain_cours || $cours_datetime < ($prochain_cours['date_cours'] . ' ' . $prochain_cours['heure_debut'])) {
                    $prochain_cours = $c;
                }
            }
        }

        $data = [
            'prof_nom'       => $_SESSION['prof_nom'] ?? 'Professeur',
            'specialite'     => $_SESSION['prof_specialite'] ?? '',
            'mes_cours'      => array_values($mesCours),
            'filieres'       => $filieres_uniques,
            'prochain_cours' => $prochain_cours,
        ];

        $this->view('professeur/dashboard', $data);
    }

    public function logout()
    {
        unset($_SESSION['prof_id'], $_SESSION['prof_email'], $_SESSION['prof_nom'], $_SESSION['prof_specialite']);
        session_destroy();
        header('Location: /');
        exit();
    }
}
