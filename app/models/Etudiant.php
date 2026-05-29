<?php
/**
 * TODO:
 * - Ajouter des méthodes spécifiques pour la recherche
 */

class Etudiant
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM etudiants ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM etudiants WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO etudiants (nom, prenom, email, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, created_by) 
                  VALUES (:nom, :prenom, :email, :tuteur_nom, :tuteur_contact, :date_naissance, :annee_scolaire, :created_by)";
        $stmt = $this->db->prepare($query);

        $nom = htmlspecialchars(strip_tags($data['nom']));
        $prenom = htmlspecialchars(strip_tags($data['prenom']));
        $email = trim($data['email']);
        $tuteur_nom = htmlspecialchars(strip_tags($data['tuteur_nom']));
        $tuteur_contact = htmlspecialchars(strip_tags($data['tuteur_contact']));
        $date_naissance = $data['date_naissance'];
        $annee_scolaire = htmlspecialchars(strip_tags($data['annee_scolaire']));
        $created_by = $data['created_by'] ?? null;

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tuteur_nom', $tuteur_nom);
        $stmt->bindParam(':tuteur_contact', $tuteur_contact);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':annee_scolaire', $annee_scolaire);
        $stmt->bindParam(':created_by', $created_by);

        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $query = "UPDATE etudiants 
                  SET nom = :nom, prenom = :prenom, email = :email, tuteur_nom = :tuteur_nom, 
                      tuteur_contact = :tuteur_contact, date_naissance = :date_naissance, annee_scolaire = :annee_scolaire 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $nom = htmlspecialchars(strip_tags($data['nom']));
        $prenom = htmlspecialchars(strip_tags($data['prenom']));
        $email = trim($data['email']);
        $tuteur_nom = htmlspecialchars(strip_tags($data['tuteur_nom']));
        $tuteur_contact = htmlspecialchars(strip_tags($data['tuteur_contact']));
        $date_naissance = $data['date_naissance'];
        $annee_scolaire = htmlspecialchars(strip_tags($data['annee_scolaire']));

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tuteur_nom', $tuteur_nom);
        $stmt->bindParam(':tuteur_contact', $tuteur_contact);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':annee_scolaire', $annee_scolaire);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM etudiants";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$result['total'];
    }
}
