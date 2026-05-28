<?php
// app/models/Etudiant.php

class Etudiant
{
    private $db;

    // Le constructeur
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * 1. Lister tous les étudiants pour le Dashboard
     */
    public function getAll()
    {
        // On trie par ID décroissant pour voir les derniers inscrits en premier
        // Si tu as une colonne 'date_creation' ou 'created_at', tu pourras remplacer 'id' par celle-ci
        $query = "SELECT * FROM etudiants ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 2. Voir la fiche d'un étudiant par son ID
     */
    public function getById($id)
    {
        $query = "SELECT * FROM etudiants WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 3. Inscrire un nouvel étudiant
     */
    public function create($data)
    {
        // Adapte les colonnes (nom, prenom, email, matricule, etc.) selon ta table SQL réelle
        $query = "INSERT INTO etudiants (nom, prenom, email, matricule) 
                  VALUES (:nom, :prenom, :email, :matricule)";
        $stmt = $this->db->prepare($query);

        // Nettoyage des données pour éviter les failles
        $nom = htmlspecialchars(strip_tags($data['nom']));
        $prenom = htmlspecialchars(strip_tags($data['prenom']));
        $email = trim($data['email']);
        $matricule = htmlspecialchars(strip_tags($data['matricule']));

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':matricule', $matricule);

        return $stmt->execute();
    }

    /**
     * 4. Mettre à jour les informations d'un étudiant
     */
    public function update($id, $data)
    {
        $query = "UPDATE etudiants 
                  SET nom = :nom, prenom = :prenom, email = :email, matricule = :matricule 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $nom = htmlspecialchars(strip_tags($data['nom']));
        $prenom = htmlspecialchars(strip_tags($data['prenom']));
        $email = trim($data['email']);
        $matricule = htmlspecialchars(strip_tags($data['matricule']));

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':matricule', $matricule);

        return $stmt->execute();
    }

    /**
     * 5. Supprimer un étudiant
     */
    public function delete($id)
    {
        $query = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * 6. Compter le nombre total d'étudiants pour les statistiques du Dashboard
     */
    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM etudiants";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$result['total'];
    }
}
