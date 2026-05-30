<?php
/**
 * Modèle Etudiant - Version Finale Stable & Corrigée
 * Intègre la gestion du statut et le stockage du chemin de la photo (photo_url) dans le CRUD.
 */

class Etudiant
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Récupère tous les étudiants avec le NOM de leur filière explicite
     */
    public function getAll()
    {
        $query = "SELECT e.*, f.nom AS nom_filiere 
                  FROM etudiants e 
                  LEFT JOIN filieres f ON e.filiere_id = f.id 
                  ORDER BY e.id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un étudiant spécifique par son ID
     */
    public function getById($id)
    {
        $query = "SELECT e.*, f.nom AS nom_filiere 
                  FROM etudiants e 
                  LEFT JOIN filieres f ON e.filiere_id = f.id 
                  WHERE e.id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * CORRECTION : Crée un nouvel étudiant en incluant sa photo (photo_url)
     */
    public function create($data)
    {
        $query = "INSERT INTO etudiants (nom, prenom, email, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, statut, photo_url, filiere_id, created_by) 
                  VALUES (:nom, :prenom, :email, :tuteur_nom, :tuteur_contact, :date_naissance, :annee_scolaire, :statut, :photo_url, :filiere_id, :created_by)";
        $stmt = $this->db->prepare($query);

        $nom            = htmlspecialchars(strip_tags($data['nom']));
        $prenom         = htmlspecialchars(strip_tags($data['prenom']));
        $email          = !empty($data['email']) ? trim($data['email']) : null;
        $tuteur_nom     = htmlspecialchars(strip_tags($data['tuteur_nom']));
        $tuteur_contact = htmlspecialchars(strip_tags($data['tuteur_contact']));
        $date_naissance = $data['date_naissance'];
        $annee_scolaire = htmlspecialchars(strip_tags($data['annee_scolaire']));
        $statut         = !empty($data['statut']) ? trim($data['statut']) : 'en attente';
        $photo_url      = $data['photo_url'] ?? null; // Aligné sur la BDD
        $filiere_id     = !empty($data['filiere_id']) ? (int)$data['filiere_id'] : null;
        $created_by     = $data['created_by'] ?? null;

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tuteur_nom', $tuteur_nom);
        $stmt->bindParam(':tuteur_contact', $tuteur_contact);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':annee_scolaire', $annee_scolaire);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':photo_url', $photo_url); // Liaison corrigée
        $stmt->bindParam(':filiere_id', $filiere_id, PDO::PARAM_INT);
        $stmt->bindParam(':created_by', $created_by);

        return $stmt->execute();
    }

    /**
     * CORRECTION : Met à jour les infos de l'étudiant Y COMPRIS son statut et sa PHOTO (photo_url)
     */
    public function update($id, $data)
    {
        $query = "UPDATE etudiants 
                  SET nom = :nom, prenom = :prenom, email = :email, tuteur_nom = :tuteur_nom, 
                      tuteur_contact = :tuteur_contact, date_naissance = :date_naissance, 
                      annee_scolaire = :annee_scolaire, statut = :statut, photo_url = :photo_url, filiere_id = :filiere_id 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $nom            = htmlspecialchars(strip_tags($data['nom']));
        $prenom         = htmlspecialchars(strip_tags($data['prenom']));
        $email          = !empty($data['email']) ? trim($data['email']) : null;
        $tuteur_nom     = htmlspecialchars(strip_tags($data['tuteur_nom']));
        $tuteur_contact = htmlspecialchars(strip_tags($data['tuteur_contact']));
        $date_naissance = $data['date_naissance'];
        $annee_scolaire = htmlspecialchars(strip_tags($data['annee_scolaire']));
        $statut         = !empty($data['statut']) ? trim($data['statut']) : 'en attente';
        $photo_url      = $data['photo_url'] ?? null; // Aligné sur la BDD
        $filiere_id     = !empty($data['filiere_id']) ? (int)$data['filiere_id'] : null;

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tuteur_nom', $tuteur_nom);
        $stmt->bindParam(':tuteur_contact', $tuteur_contact);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':annee_scolaire', $annee_scolaire);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':photo_url', $photo_url); // Liaison corrigée
        $stmt->bindParam(':filiere_id', $filiere_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Supprime un étudiant du registre
     */
    public function delete($id)
    {
        $query = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Compte le nombre total d'étudiants enregistrés
     */
    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM etudiants";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }

    /**
     * Recherche un étudiant par nom, prénom, email ou filière
     */
    public function search($term)
    {
        $query = "SELECT e.*, f.nom AS nom_filiere 
                  FROM etudiants e 
                  LEFT JOIN filieres f ON e.filiere_id = f.id 
                  WHERE e.nom LIKE :term 
                     OR e.prenom LIKE :term 
                     OR e.email LIKE :term
                     OR f.nom LIKE :term
                  ORDER BY e.id DESC";
                  
        $stmt = $this->db->prepare($query);
        $searchTerm = "%" . $term . "%";
        $stmt->bindParam(':term', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Statistiques globales des effectifs par filière
     */
    public function getStatsParFiliere()
    {
        $query = "SELECT f.id, f.code, f.nom, COUNT(e.id) AS total_etudiants 
                  FROM filieres f
                  LEFT JOIN etudiants e ON f.id = e.filiere_id 
                  GROUP BY f.id, f.code, f.nom
                  ORDER BY total_etudiants DESC";
                  
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Permet les modifications de statut indépendantes (ex : boutons rapides du dashboard)
     */
    public function updateStatutInscription($id, $nouveauStatut)
    {
        $query = "UPDATE etudiants SET statut = :statut WHERE id = :id";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':statut', $nouveauStatut, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}