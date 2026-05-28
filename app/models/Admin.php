<?php
// app/models/Admin.php

class Admin
{
    private $db;

    // Le constructeur
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Recherche un administrateur par son email
     */
    public function findByEmail($email)
    {
        $query = "SELECT * FROM administrateurs WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel administrateur
     */
    public function create($data)
    {
        $query = "INSERT INTO administrateurs (pseudo, email, password)
                  VALUES (:pseudo, :email, :password)";
        $stmt = $this->db->prepare($query);

        // Nettoyage des données
        $pseudo = htmlspecialchars(strip_tags($data['pseudo']));
        // On ne nettoie pas l'email avec htmlspecialchars pour éviter de corrompre l'adresse
        $email = trim($data['email']);

        // Hashage sécurisé du mot de passe (Reçoit bien 'password' du contrôleur)
        $password_hashed = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hashed);

        return $stmt->execute();
    }

    /**
     * Récupère tous les administrateurs
     */
    public function getAll()
    {
        $query = "SELECT id, pseudo, email, date_creation FROM administrateurs ORDER BY date_creation DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre total d'administrateurs
     */
    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM administrateurs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$result['total'];
    }
}
