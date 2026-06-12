<?php

class Professeur
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM professeurs ORDER BY nom ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getValidated()
    {
        $query = "SELECT * FROM professeurs WHERE accord_dg = 1 ORDER BY nom ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO professeurs (nom, prenom, email, telephone, specialite, accord_dg) 
                  VALUES (:nom, :prenom, :email, :telephone, :specialite, 0)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'] ?? null,
            ':telephone' => $data['telephone'],
            ':specialite' => $data['specialite'] ?? null
        ]);
    }

    public function validate($id)
    {
        $query = "UPDATE professeurs SET accord_dg = 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM professeurs WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function validateWithPassword($id, $password_hash)
    {
        $query = "UPDATE professeurs SET accord_dg = 1, password = :password WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':password' => $password_hash, ':id' => $id]);
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM professeurs WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCandidatures()
    {
        $query = "SELECT * FROM professeurs WHERE accord_dg = 0 ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
