<?php

class PlanningCours
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function checkCollision($professeur_id, $salle_id, $date_cours, $heure_debut, $heure_fin)
    {
        // Anti-collision logic (Scénario 3 du MCT)
        // 1. Est-ce que le prof a accord_dg = 1 ?
        $stmt = $this->db->prepare("SELECT accord_dg FROM professeurs WHERE id = :prof_id");
        $stmt->execute([':prof_id' => $professeur_id]);
        $prof = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$prof || $prof['accord_dg'] != 1) {
            return "Le professeur sélectionné n'est pas validé par le DG.";
        }

        // 2. Est-ce que la salle est dispo ?
        $stmt = $this->db->prepare("SELECT etat_dispo FROM salles WHERE id = :salle_id");
        $stmt->execute([':salle_id' => $salle_id]);
        $salle = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$salle || $salle['etat_dispo'] !== 'Disponible') {
            return "La salle sélectionnée n'est pas disponible.";
        }

        // 3. Chevauchement Professeur ou Salle
        $query = "SELECT id FROM planning_cours 
                  WHERE date_cours = :date_cours 
                  AND (
                      (professeur_id = :prof_id) OR (salle_id = :salle_id)
                  )
                  AND (
                      (heure_debut < :heure_fin AND heure_fin > :heure_debut)
                  )";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':date_cours' => $date_cours,
            ':prof_id'    => $professeur_id,
            ':salle_id'   => $salle_id,
            ':heure_debut'=> $heure_debut,
            ':heure_fin'  => $heure_fin
        ]);

        if ($stmt->fetch()) {
            return "Collision détectée : Le professeur ou la salle est déjà occupé sur ce créneau.";
        }

        return true; // Tout est vert
    }

    public function create($data)
    {
        $collision_check = $this->checkCollision(
            $data['professeur_id'], 
            $data['salle_id'], 
            $data['date_cours'], 
            $data['heure_debut'], 
            $data['heure_fin']
        );

        if ($collision_check !== true) {
            return ['success' => false, 'message' => $collision_check];
        }

        $query = "INSERT INTO planning_cours (filiere_id, matiere_id, professeur_id, salle_id, date_cours, heure_debut, heure_fin, created_by) 
                  VALUES (:filiere_id, :matiere_id, :professeur_id, :salle_id, :date_cours, :heure_debut, :heure_fin, :created_by)";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([
            ':filiere_id'    => $data['filiere_id'],
            ':matiere_id'    => $data['matiere_id'],
            ':professeur_id' => $data['professeur_id'],
            ':salle_id'      => $data['salle_id'],
            ':date_cours'    => $data['date_cours'],
            ':heure_debut'   => $data['heure_debut'],
            ':heure_fin'     => $data['heure_fin'],
            ':created_by'    => $data['created_by']
        ]);

        if ($success) {
            return ['success' => true, 'message' => 'Cours planifié avec succès.'];
        }
        return ['success' => false, 'message' => 'Erreur lors de la planification du cours en base de données.'];
    }

    public function getAll()
    {
        $query = "SELECT p.*, f.nom as filiere_nom, m.nom as matiere_nom, 
                         pr.nom as prof_nom, pr.prenom as prof_prenom, s.nom as salle_nom
                  FROM planning_cours p
                  JOIN filieres f ON p.filiere_id = f.id
                  JOIN matieres m ON p.matiere_id = m.id
                  JOIN professeurs pr ON p.professeur_id = pr.id
                  JOIN salles s ON p.salle_id = s.id
                  ORDER BY p.date_cours DESC, p.heure_debut ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
