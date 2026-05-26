<?php

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Bienvenue sur MVC Project',
            'description' => 'Ceci est la page d\'accueil de votre nouveau projet MVC.'
        ];
        $this->view('home', $data);
    }
}
