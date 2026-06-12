<?php
/**
 * TODO:
 * - Supporter les paramètres dynamiques (ex: /etudiant/{id})
 * - Séparer les routes GET et POST
 * - Ajouter une page 404 personnalisée au lieu d'un simple texte
 * - Ajouter un middleware d'authentification
 * - Créer une vue 404 dédiée (app/views/errors/404.php)
 */

class Router {
    protected $routes = [];

    public function add($route, $controllerAction) {
        $this->routes[$route] = $controllerAction;
    }

    public function dispatch($url) {
        $url = parse_url($url, PHP_URL_PATH);
        
        if (array_key_exists($url, $this->routes)) {
            $parts = explode('@', $this->routes[$url]);
            $controllerPath = $parts[0];
            $actionName = $parts[1];

            require_once ROOT_PATH . '/app/controllers/' . $controllerPath . '.php';
            
            // Extract the actual class name from the path (e.g. admin/DashboardController -> DashboardController)
            $controllerName = basename($controllerPath);
            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            http_response_code(404);
            echo "<h1>404 - Page non trouvée</h1>";
            echo "<p>La page demandée n'existe pas.</p>";
            echo "<a href='/'>Retour à l'accueil</a>";
        }
    }
}
