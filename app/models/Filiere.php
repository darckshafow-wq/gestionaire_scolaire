<?php

class Filiere
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM filieres ORDER BY nom ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM filieres WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO filieres (code, nom, description, duree_annees, niveau, statut)
             VALUES (:code, :nom, :description, :duree_annees, :niveau, :statut)"
        );

        $code        = strtoupper(htmlspecialchars(strip_tags($data['code'])));
        $nom         = htmlspecialchars(strip_tags($data['nom']));
        $description = htmlspecialchars(strip_tags($data['description'] ?? ''));
        $duree       = (int)($data['duree_annees'] ?? 3);
        $niveau      = htmlspecialchars(strip_tags($data['niveau'] ?? 'Licence'));
        $statut      = in_array($data['statut'] ?? '', ['Active', 'Inactive']) ? $data['statut'] : 'Active';

        $stmt->bindParam(':code',        $code);
        $stmt->bindParam(':nom',         $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':duree_annees',$duree, PDO::PARAM_INT);
        $stmt->bindParam(':niveau',      $niveau);
        $stmt->bindParam(':statut',      $statut);

        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare(
            "UPDATE filieres
             SET code = :code, nom = :nom, description = :description,
                 duree_annees = :duree_annees, niveau = :niveau, statut = :statut
             WHERE id = :id"
        );

        $code        = strtoupper(htmlspecialchars(strip_tags($data['code'])));
        $nom         = htmlspecialchars(strip_tags($data['nom']));
        $description = htmlspecialchars(strip_tags($data['description'] ?? ''));
        $duree       = (int)($data['duree_annees'] ?? 3);
        $niveau      = htmlspecialchars(strip_tags($data['niveau'] ?? 'Licence'));
        $statut      = in_array($data['statut'] ?? '', ['Active', 'Inactive']) ? $data['statut'] : 'Active';

        $stmt->bindParam(':id',          $id,          PDO::PARAM_INT);
        $stmt->bindParam(':code',        $code);
        $stmt->bindParam(':nom',         $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':duree_annees',$duree,       PDO::PARAM_INT);
        $stmt->bindParam(':niveau',      $niveau);
        $stmt->bindParam(':statut',      $statut);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM filieres WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function countAll()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM filieres");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }

    public function codeExists($code, $excludeId = null)
    {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id FROM filieres WHERE code = :code AND id != :id LIMIT 1");
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare("SELECT id FROM filieres WHERE code = :code LIMIT 1");
        }
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}
