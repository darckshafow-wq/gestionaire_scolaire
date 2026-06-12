-- ============================================================
--  FICHIER OBSOLÈTE - Utilisez data/schema.sql à la place
-- ============================================================
--  Ce fichier est conservé pour référence uniquement.
--  Le schéma complet (avec filieres + triggers) se trouve dans :
--    data/schema.sql
-- ============================================================

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_scolaire CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_scolaire;

-- Table des Administrateurs
CREATE TABLE IF NOT EXISTS administrateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    pseudo VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des Filières
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
);

-- Table des Étudiants (Registre)
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
);
