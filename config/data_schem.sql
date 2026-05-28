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
    statut VARCHAR(200) DEFAULT 'en attente',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES administrateurs(id) ON DELETE SET NULL
);
