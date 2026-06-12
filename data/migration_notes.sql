-- ============================================================
-- Migration : Ajout de la table notes et modification matieres
-- ============================================================

-- 1. Ajout de la colonne coefficient à la table matieres
ALTER TABLE matieres ADD COLUMN coefficient INT NOT NULL DEFAULT 1;

-- 2. Création de la table notes
CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    matiere_id INT NOT NULL,
    professeur_id INT NOT NULL,
    valeur DECIMAL(5, 2) NOT NULL,
    commentaire VARCHAR(255) DEFAULT NULL,
    date_evaluation DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES etudiants(id) ON DELETE CASCADE,
    FOREIGN KEY (matiere_id) REFERENCES matieres(id) ON DELETE CASCADE,
    FOREIGN KEY (professeur_id) REFERENCES professeurs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
