<?php

class Salle
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM salles ORDER BY nom ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDisponibles()
    {
        $query = "SELECT * FROM salles WHERE etat_dispo = 'Disponible' ORDER BY nom ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nom, $capacite, $etat)
    {
        try {
            $query = "INSERT INTO salles (nom, capacite, etat_dispo) VALUES (:nom, :capacite, :etat)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':nom' => $nom,
                ':capacite' => $capacite,
                ':etat' => $etat
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateEtat($id, $etat)
    {
        $query = "UPDATE salles SET etat_dispo = :etat WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':etat' => $etat, ':id' => $id]);
    }

    public function delete($id)
    {
        try {
            $query = "DELETE FROM salles WHERE id = :id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
