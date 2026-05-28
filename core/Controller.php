<?php
/**
 * ============================================================
 *  CLASSE CONTROLLER - Contrôleur de base
 * ============================================================
 * 
 * Tous les contrôleurs (AuthController, DashboardController, etc.)
 * héritent de cette classe pour accéder aux méthodes utilitaires.
 * 
 * ✅ FAIT :
 *   - view() : charge une vue PHP en lui passant des données
 *   - model() : charge et instancie un modèle
 * 
 * 🔧 À FAIRE (TODO) :
 *   - Ajouter une méthode redirect($url) pour simplifier les redirections
 *   - Ajouter une méthode isLoggedIn() pour vérifier la session
 *   - Ajouter une méthode json($data) pour les réponses API
 */

class Controller {

    /**
     * Charge une vue et lui passe des données
     * 
     * @param string $view  Chemin relatif de la vue (ex: 'dashboard/index')
     * @param array  $data  Données à rendre disponibles dans la vue
     * 
     * Exemple : $this->view('dashboard/index', ['total_etudiants' => 150])
     * → charge app/views/dashboard/index.php avec $total_etudiants = 150
     */
    public function view($view, $data = []) {
        // extract() transforme les clés du tableau en variables PHP
        // ['total_etudiants' => 150] devient $total_etudiants = 150
        extract($data);
        require_once ROOT_PATH . '/app/views/' . $view . '.php';
    }

    /**
     * Charge un modèle et retourne une instance
     * 
     * @param string $model  Nom du modèle (ex: 'Admin', 'Etudiant')
     * @return object  Instance du modèle
     * 
     * Exemple : $adminModel = $this->model('Admin');
     */
    public function model($model) {
        require_once ROOT_PATH . '/app/models/' . $model . '.php';
        return new $model();
    }
}
