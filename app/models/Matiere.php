<?php

class Matiere
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllByFiliere($filiere_id)
    {
        $query = "SELECT m.*, f.nom as filiere_nom 
                  FROM matieres m 
                  JOIN filieres f ON m.filiere_id = f.id 
                  WHERE m.filiere_id = :filiere_id 
                  ORDER BY m.nom ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':filiere_id', $filiere_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByFiliere($filiere_id)
    {
        return $this->getAllByFiliere($filiere_id);
    }

    public function create($filiere_id, $nom, $volume_horaire, $coefficient = 1)
    {
        $query = "INSERT INTO matieres (filiere_id, nom, volume_horaire, coefficient) VALUES (:filiere_id, :nom, :volume_horaire, :coefficient)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':filiere_id', $filiere_id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':volume_horaire', $volume_horaire);
        $stmt->bindParam(':coefficient', $coefficient);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM matieres WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
