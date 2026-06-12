<?php

class Note
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function saveNote($etudiant_id, $matiere_id, $professeur_id, $valeur, $commentaire)
    {
        try {
            // Check if note already exists to update it, or insert new
            $query = "SELECT id FROM notes WHERE etudiant_id = :etudiant_id AND matiere_id = :matiere_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':etudiant_id' => $etudiant_id, ':matiere_id' => $matiere_id]);
            
            if ($stmt->rowCount() > 0) {
                // Update
                $q = "UPDATE notes SET valeur = :valeur, commentaire = :commentaire, date_evaluation = CURDATE() 
                      WHERE etudiant_id = :etudiant_id AND matiere_id = :matiere_id";
                $update = $this->db->prepare($q);
                return $update->execute([
                    ':valeur' => $valeur,
                    ':commentaire' => $commentaire,
                    ':etudiant_id' => $etudiant_id,
                    ':matiere_id' => $matiere_id
                ]);
            } else {
                // Insert
                $q = "INSERT INTO notes (etudiant_id, matiere_id, professeur_id, valeur, commentaire, date_evaluation) 
                      VALUES (:etudiant_id, :matiere_id, :professeur_id, :valeur, :commentaire, CURDATE())";
                $insert = $this->db->prepare($q);
                return $insert->execute([
                    ':etudiant_id' => $etudiant_id,
                    ':matiere_id' => $matiere_id,
                    ':professeur_id' => $professeur_id,
                    ':valeur' => $valeur,
                    ':commentaire' => $commentaire
                ]);
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getNotesByEtudiant($etudiant_id)
    {
        $query = "SELECT n.*, m.nom as matiere_nom, m.coefficient 
                  FROM notes n 
                  JOIN matieres m ON n.matiere_id = m.id 
                  WHERE n.etudiant_id = :etudiant_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':etudiant_id' => $etudiant_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getNotesByMatiere($matiere_id)
    {
        $query = "SELECT n.*, e.nom as etudiant_nom, e.prenom as etudiant_prenom 
                  FROM notes n 
                  JOIN etudiants e ON n.etudiant_id = e.id 
                  WHERE n.matiere_id = :matiere_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':matiere_id' => $matiere_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculerMoyenneEtudiant($etudiant_id)
    {
        $notes = $this->getNotesByEtudiant($etudiant_id);
        if (empty($notes)) return 0;

        $totalPoints = 0;
        $totalCoef = 0;

        foreach ($notes as $n) {
            $totalPoints += ($n['valeur'] * $n['coefficient']);
            $totalCoef += $n['coefficient'];
        }

        return $totalCoef > 0 ? round($totalPoints / $totalCoef, 2) : 0;
    }
}
