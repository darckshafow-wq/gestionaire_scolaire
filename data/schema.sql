-- ============================================================
--  SCHEMA DE LA BASE DE DONNÉES - Système de Gestion Scolaire
--  EPI Gest Pro
-- ============================================================
--  Pour initialiser le projet :
--    1. Ouvrir un terminal MySQL/MariaDB
--    2. Exécuter : source /chemin/vers/ce/fichier/schema.sql
-- ============================================================

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_scolaire CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_scolaire;

-- ============================================================
--  TABLE : administrateurs
-- ============================================================
CREATE TABLE IF NOT EXISTS administrateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    pseudo VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  TABLE : filieres
-- ============================================================
CREATE TABLE IF NOT EXISTS filieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    nom VARCHAR(150) NOT NULL,
    description TEXT DEFAULT NULL,
    duree_annees INT NOT NULL DEFAULT 3,
    niveau VARCHAR(50) NOT NULL DEFAULT 'Licence',
    statut ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  TABLE : etudiants
-- ============================================================
CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    photo_url VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    tuteur_nom VARCHAR(100) NOT NULL,
    tuteur_contact VARCHAR(50) NOT NULL,
    date_naissance DATE NOT NULL,
    annee_scolaire VARCHAR(20) NOT NULL,
    filiere_id INT DEFAULT NULL,
    statut VARCHAR(200) DEFAULT 'en attente',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES administrateurs(id) ON DELETE SET NULL,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
--  TRIGGER : Empêcher la suppression d'une filière si elle a
--            encore des étudiants rattachés
-- ============================================================
DELIMITER //

CREATE TRIGGER before_filiere_delete
BEFORE DELETE ON filieres
FOR EACH ROW
BEGIN
    DECLARE nb_etudiants INT;
    SELECT COUNT(*) INTO nb_etudiants FROM etudiants WHERE filiere_id = OLD.id;
    IF nb_etudiants > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Impossible de supprimer cette filière : des étudiants y sont encore rattachés.';
    END IF;
END //

DELIMITER ;

-- ============================================================
--  DONNÉES DE DÉMARRAGE (Filières par défaut)
-- ============================================================
INSERT INTO filieres (code, nom, description, duree_annees, niveau, statut) VALUES
('INFO', 'Informatique et Réseaux', 'Formation en développement logiciel, réseaux et systèmes informatiques.', 3, 'Licence', 'Active'),
('GC', 'Génie Civil', 'Formation en conception et construction d''ouvrages de génie civil.', 3, 'Licence', 'Active'),
('GE', 'Génie Électrique', 'Formation en électronique, électrotechnique et automatisme.', 3, 'Licence', 'Active'),
('GM', 'Génie Mécanique', 'Formation en conception mécanique et maintenance industrielle.', 3, 'Licence', 'Active'),
('MKT', 'Marketing et Commerce', 'Formation en stratégie commerciale, marketing digital et vente.', 3, 'Licence', 'Active'),
('CG', 'Comptabilité et Gestion', 'Formation en comptabilité, finance et gestion d''entreprise.', 2, 'BTS', 'Active');

-- ============================================================
--  DONNÉES DE DÉMARRAGE (Admin par défaut)
--  Email: admin@epi.edu.ci  |  Mot de passe: password123
-- ============================================================
INSERT INTO administrateurs (email, pseudo, password) VALUES
('admin@epi.edu.ci', 'SuperAdmin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
