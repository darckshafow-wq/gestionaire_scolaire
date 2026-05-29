<?php

class ParametresController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public function parametres()
    {
        $this->requireAuth();
        $this->view('dashboard/parametres');
    }
}
