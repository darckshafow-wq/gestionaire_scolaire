<?php

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
