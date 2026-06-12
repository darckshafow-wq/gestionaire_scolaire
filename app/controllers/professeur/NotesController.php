<?php

require_once ROOT_PATH . '/app/models/Note.php';
require_once ROOT_PATH . '/app/models/Etudiant.php';
require_once ROOT_PATH . '/app/models/Matiere.php';

class NotesController extends Controller
{
    private function requireAuth()
    {
        if (!isset($_SESSION['prof_id'])) {
            header('Location: /login_personnel');
            exit();
        }
    }

    public function index()
    {
        $this->requireAuth();
        $prof_id = $_SESSION['prof_id'];

        // Get classes/matières assigned to this prof
        $db = (new Database())->getConnection();
        // Les matières que ce prof enseigne (via le planning)
        $query = "SELECT DISTINCT m.id, m.nom, m.coefficient, f.id as filiere_id, f.nom as filiere_nom 
                  FROM planning_cours p
                  JOIN matieres m ON p.matiere_id = m.id
                  JOIN filieres f ON p.filiere_id = f.id
                  WHERE p.professeur_id = :prof_id";
        $stmt = $db->prepare($query);
        $stmt->execute([':prof_id' => $prof_id]);
        $mes_classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $matiere_id = (int)($_GET['matiere_id'] ?? 0);
        $etudiants = [];
        $matiere_actuelle = null;
        $notes_existantes = [];

        if ($matiere_id) {
            // Check if prof actually teaches this matiere
            $is_valid = false;
            foreach ($mes_classes as $c) {
                if ($c['id'] == $matiere_id) {
                    $is_valid = true;
                    $matiere_actuelle = $c;
                    break;
                }
            }

            if ($is_valid) {
                $etudiantModel = new Etudiant();
                // Get all students in this filiere
                // Wait, EtudiantModel might not have getByFiliere, we can write a query here or add it
                $q_etu = "SELECT * FROM etudiants WHERE filiere_id = :filiere_id AND statut = 'Validé'";
                $s_etu = $db->prepare($q_etu);
                $s_etu->execute([':filiere_id' => $matiere_actuelle['filiere_id']]);
                $etudiants = $s_etu->fetchAll(PDO::FETCH_ASSOC);

                $noteModel = new Note();
                $all_notes = $noteModel->getNotesByMatiere($matiere_id);
                foreach ($all_notes as $n) {
                    $notes_existantes[$n['etudiant_id']] = $n;
                }
            }
        }

        $data = [
            'prof_pseudo'      => $_SESSION['prof_nom'] ?? 'Professeur',
            'mes_classes'      => $mes_classes,
            'matiere_id'       => $matiere_id,
            'matiere_actuelle' => $matiere_actuelle,
            'etudiants'        => $etudiants,
            'notes_existantes' => $notes_existantes
        ];

        $this->view('professeur/notes', $data);
    }

    public function save()
    {
        $this->requireAuth();
        $prof_id = $_SESSION['prof_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matiere_id = (int)($_POST['matiere_id'] ?? 0);
            $notes = $_POST['notes'] ?? []; // Array [etudiant_id => valeur]
            $commentaires = $_POST['commentaires'] ?? [];

            $noteModel = new Note();
            $success = true;

            foreach ($notes as $etudiant_id => $valeur) {
                if ($valeur !== '' && is_numeric($valeur)) {
                    $val = min(20, max(0, (float)$valeur)); // Clamp between 0 and 20
                    $com = htmlspecialchars($commentaires[$etudiant_id] ?? '');
                    if (!$noteModel->saveNote($etudiant_id, $matiere_id, $prof_id, $val, $com)) {
                        $success = false;
                    }
                }
            }

            if ($success) {
                $_SESSION['snackbar'] = "Les notes ont été enregistrées avec succès.";
            } else {
                $_SESSION['snackbar_error'] = "Erreur lors de l'enregistrement de certaines notes.";
            }

            header("Location: /professeur/notes?matiere_id=" . $matiere_id);
            exit();
        }
    }
}
