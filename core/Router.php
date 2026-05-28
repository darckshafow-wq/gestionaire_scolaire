<?php
/**
 * ============================================================
 *  CLASSE ROUTER - Routage des requêtes HTTP
 * ============================================================
 * 
 * Gère l'association URL → Controller@method.
 * 
 * ✅ FAIT :
 *   - Ajout de routes (add)
 *   - Dispatch vers le bon contrôleur et la bonne méthode
 *   - Gestion 404 basique
 * 
 * 🔧 À FAIRE (TODO) :
 *   - Supporter les paramètres dynamiques (ex: /etudiant/{id})
 *   - Séparer les routes GET et POST
 *   - Ajouter une page 404 personnalisée au lieu d'un simple texte
 *   - Ajouter un middleware d'authentification
 */

class Router {
    protected $routes = [];

    /**
     * Enregistre une route : associe une URL à un Controller@method
     * 
     * @param string $route       L'URL (ex: '/dashboard')
     * @param string $controllerAction  Le controller et la méthode (ex: 'DashboardController@index')
     */
    public function add($route, $controllerAction) {
        $this->routes[$route] = $controllerAction;
    }

    /**
     * Dispatche la requête : trouve la route correspondante et exécute le controller
     * 
     * @param string $url  L'URL demandée ($_SERVER['REQUEST_URI'])
     */
    public function dispatch($url) {
        // On extrait le chemin sans les paramètres GET (?page=1, etc.)
        $url = parse_url($url, PHP_URL_PATH);
        
        if (array_key_exists($url, $this->routes)) {
            // Sépare "DashboardController@index" en ["DashboardController", "index"]
            $parts = explode('@', $this->routes[$url]);
            $controllerName = $parts[0];
            $actionName = $parts[1];

            // Charge le fichier du contrôleur et instancie la classe
            require_once ROOT_PATH . '/app/controllers/' . $controllerName . '.php';
            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            // TODO: Créer une vue 404 dédiée (app/views/errors/404.php)
            http_response_code(404);
            echo "<h1>404 - Page non trouvée</h1>";
            echo "<p>La page demandée n'existe pas.</p>";
            echo "<a href='/'>Retour à l'accueil</a>";
        }
    }
}
