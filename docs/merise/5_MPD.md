# Modèle Physique des Données (MPD)

Le MPD correspond à la transcription du MLD dans le langage de définition de données (DDL) du SGBD cible, ici **MySQL / MariaDB**.

Il définit les types physiques réels, les contraintes d'intégrité (clés étrangères, clauses `ON DELETE CASCADE`), et les index pour optimiser les requêtes.

```sql
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_scolaire CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_scolaire;

-- 1. administrateurs
CREATE TABLE IF NOT EXISTS administrateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    pseudo VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('secretaire', 'dg') NOT NULL DEFAULT 'secretaire',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. filieres
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
) ENGINE=InnoDB;

-- 3. matieres
CREATE TABLE IF NOT EXISTS matieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filiere_id INT NOT NULL,
    nom VARCHAR(150) NOT NULL,
    volume_horaire INT NOT NULL DEFAULT 20,
    coefficient INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. professeurs
CREATE TABLE IF NOT EXISTS professeurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    telephone VARCHAR(20) NOT NULL,
    specialite VARCHAR(150),
    accord_dg TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 5. salles
CREATE TABLE IF NOT EXISTS salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    capacite INT NOT NULL,
    etat_dispo ENUM('Disponible', 'Indisponible', 'En maintenance') DEFAULT 'Disponible',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 6. etudiants
CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255),
    tuteur_nom VARCHAR(150) NOT NULL,
    tuteur_contact VARCHAR(20) NOT NULL,
    date_naissance DATE NOT NULL,
    annee_scolaire VARCHAR(20) NOT NULL,
    statut ENUM('en attente', 'Validé', 'Refusé') DEFAULT 'en attente',
    filiere_id INT NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES administrateurs(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 7. planning_cours
CREATE TABLE IF NOT EXISTS planning_cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filiere_id INT NOT NULL,
    matiere_id INT NOT NULL,
    professeur_id INT NOT NULL,
    salle_id INT NOT NULL,
    date_cours DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE CASCADE,
    FOREIGN KEY (matiere_id) REFERENCES matieres(id) ON DELETE CASCADE,
    FOREIGN KEY (professeur_id) REFERENCES professeurs(id) ON DELETE CASCADE,
    FOREIGN KEY (salle_id) REFERENCES salles(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES administrateurs(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 8. notes
CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    matiere_id INT NOT NULL,
    professeur_id INT NOT NULL,
    valeur DECIMAL(5,2) NOT NULL,
    commentaire TEXT,
    date_evaluation DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES etudiants(id) ON DELETE CASCADE,
    FOREIGN KEY (matiere_id) REFERENCES matieres(id) ON DELETE CASCADE,
    FOREIGN KEY (professeur_id) REFERENCES professeurs(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```
