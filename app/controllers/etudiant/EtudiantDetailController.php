<?php
/**
 * Contrôleur : Détails et Actions de l'Étudiant
 * Fichier : app/controllers/admin/EtudiantDetailController.php
 */

require_once ROOT_PATH . '/app/models/Etudiant.php';

class EtudiantDetailController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /login_personnel');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();
        
        $data = [
            'admin_pseudo' => $_SESSION['admin_pseudo'] ?? 'Admin',
            'etudiant'     => null
        ];

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $etudiantModel = $this->model('Etudiant');
            $etudiant = $etudiantModel->getById($id);

            if ($etudiant) {
                $data['etudiant'] = $etudiant;
                $this->view('etudiant/etudiant_detail', $data);
                return;
            }
        }

        $_SESSION['snackbar_error'] = "Erreur : Étudiant introuvable ou ID invalide.";
        header('Location: /etudiants');
        exit();
    }

    public function toggleStatut()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $etudiantModel = $this->model('Etudiant');
            
            $etudiant = $etudiantModel->getById($id);
            
            if ($etudiant) {
                $statutActuel = trim($etudiant['statut'] ?? 'en attente');
                $nouveauStatut = ($statutActuel === 'Inscrit') ? 'en attente' : 'Inscrit';
                
                if ($etudiantModel->updateStatutInscription($id, $nouveauStatut)) {
                    $_SESSION['snackbar'] = "Statut de l'étudiant mis à jour : " . ucfirst($nouveauStatut);
                } else {
                    $_SESSION['snackbar_error'] = "Impossible de modifier le statut en base de données.";
                }
            }
        }

        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/dashboard'));
        exit();
    }

    /**
     * Traitement du formulaire de modification avec gestion de photo_url
     */
    public function update()
{
    $this->requireAuth();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $etudiantModel = $this->model('Etudiant');
        $currentStudent = $etudiantModel->getById($id);

        if (!$currentStudent) {
            $_SESSION['snackbar_error'] = "Étudiant introuvable.";
            header('Location: /etudiants');
            exit();
        }

        // On conserve l'ancienne URL par défaut
        $photoPath = $currentStudent['photo_url'] ?? null;

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $fileExtension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            if (in_array($fileExtension, $allowedExtensions)) {
            // Utilise le chemin absolu complet vers le dossier que tu viens de créer
$uploadFileDir = '/home/shadow-12/Bureau/system_de_gestion_scolaire/system_de_gestion_scolaire/uploads/etudiants/';
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $newFileName = 'photo_' . $id . '_' . time() . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $destPath)) {
                    // Supprimer l'ancienne image si elle existe
                    if (!empty($currentStudent['photo_url'])) {
                        $oldFile = '/home/shadow-12/Bureau/system_de_gestion_scolaire/system_de_gestion_scolaire' . $currentStudent['photo_url'];
                        if (file_exists($oldFile)) @unlink($oldFile);
                    }
                    // URL RELATIVE pour la BDD
                    $photoPath = '/uploads/etudiants/' . $newFileName;
                }
            }
        }

        // Préparation des données
        $data = $_POST;
        $data['photo_url'] = $photoPath; // <-- C'est ici que la valeur est injectée

        if ($etudiantModel->update($id, $data)) {
            $_SESSION['snackbar'] = "Mise à jour réussie.";
        } else {
            $_SESSION['snackbar_error'] = "Erreur base de données.";
        }

        header("Location: /etudiant_detail?id=" . $id);
        exit();
    }
}
}