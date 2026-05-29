<?php
/**
 * TODO:
 * - Ajouter plus de filtres (ex: by id, pagination) si nécessaire
 */

class Admin
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM administrateurs WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO administrateurs (pseudo, email, password)
                  VALUES (:pseudo, :email, :password)";
        $stmt = $this->db->prepare($query);

        $pseudo = htmlspecialchars(strip_tags($data['pseudo']));
        $email = trim($data['email']);
        $password_hashed = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hashed);

        return $stmt->execute();
    }

    public function getAll()
    {
        $query = "SELECT id, pseudo, email, created_at FROM administrateurs ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM administrateurs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$result['total'];
    }
}
