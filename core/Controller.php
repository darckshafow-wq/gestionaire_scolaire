<?php
/**
 * TODO:
 * - Ajouter une méthode redirect($url) pour simplifier les redirections
 * - Ajouter une méthode isLoggedIn() pour vérifier la session
 * - Ajouter une méthode json($data) pour les réponses API
 */

class Controller {

    public function view($view, $data = []) {
        extract($data);
        require_once ROOT_PATH . '/app/views/' . $view . '.php';
    }

    public function model($model) {
        require_once ROOT_PATH . '/app/models/' . $model . '.php';
        return new $model();
    }
}
