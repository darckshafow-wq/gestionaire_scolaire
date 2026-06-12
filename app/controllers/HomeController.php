<?php

class HomeController extends Controller
{
    public function index()
    {
        // Si admin/staff déjà connecté, redirige selon rôle
        if (isset($_SESSION['admin_id'])) {
            $role = $_SESSION['admin_role'] ?? 'secretaire';
            if ($role === 'dg') {
                header('Location: /dg/dashboard');
            } elseif ($role === 'secretaire') {
                header('Location: /secretaire/dashboard');
            } else {
                header('Location: /');
            }
            exit();
        }
        // Si professeur connecté
        if (isset($_SESSION['prof_id'])) {
            header('Location: /professeur/dashboard');
            exit();
        }
        // Si étudiant connecté
        if (isset($_SESSION['etudiant_id'])) {
            header('Location: /etudiant/dashboard');
            exit();
        }

        $this->view('home');
    }
}
