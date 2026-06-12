-- ============================================================
-- DONNÉES DE TEST - EPI Management
-- ============================================================
-- Ce script insère des données réalistes dans toutes les tables
-- pour permettre de tester chaque module du système.
-- ============================================================

-- Le mot de passe hashé ci-dessous correspond à : password123
-- Généré via : password_hash('password123', PASSWORD_BCRYPT)
SET @hash_pwd = '$2y$10$KPHbLXsSN6MVXTBw8mHeXOXpqicoojcacW2SI3meNIZAbSB.JjHja';

-- ============================================================
-- 1. ADMINISTRATEURS (DG + Secrétaire) – déjà insérés dans schema.sql
--    On s'assure qu'ils existent
-- ============================================================
INSERT IGNORE INTO administrateurs (email, pseudo, password, role) VALUES
('admin@epi.edu.ci', 'SuperAdmin', @hash_pwd, 'dg'),
('secretaire@epi.edu.ci', 'Secrétaire', @hash_pwd, 'secretaire');

-- ============================================================
-- 2. MATIÈRES (liées aux filières existantes)
-- ============================================================
-- Filière INFO (id=1 normalement)
INSERT INTO matieres (filiere_id, nom, volume_horaire, coefficient) VALUES
(1, 'Programmation Python', 40, 3),
(1, 'Réseaux Informatiques', 35, 3),
(1, 'Base de Données', 30, 2),
(1, 'Algorithmique', 25, 2),
(1, 'Systèmes d''exploitation', 20, 1);

-- Filière GC (id=2)
INSERT INTO matieres (filiere_id, nom, volume_horaire, coefficient) VALUES
(2, 'Résistance des Matériaux', 40, 3),
(2, 'Topographie', 30, 2),
(2, 'Béton Armé', 35, 3),
(2, 'Géotechnique', 25, 2);

-- Filière GE (id=3)
INSERT INTO matieres (filiere_id, nom, volume_horaire, coefficient) VALUES
(3, 'Électronique Numérique', 35, 3),
(3, 'Automatisme', 30, 2),
(3, 'Électrotechnique', 40, 3);

-- ============================================================
-- 3. PROFESSEURS
-- ============================================================
-- Prof validé (accord_dg = 1) avec identifiants
INSERT INTO professeurs (nom, prenom, email, password, telephone, specialite, accord_dg) VALUES
('Koné', 'Moussa', 'kone.moussa@epi.edu.ci', @hash_pwd, '+225 07 12 34 56', 'Informatique', 1),
('Touré', 'Aminata', 'toure.aminata@epi.edu.ci', @hash_pwd, '+225 05 98 76 54', 'Génie Civil', 1),
('Diallo', 'Ibrahim', 'diallo.ibrahim@epi.edu.ci', @hash_pwd, '+225 01 23 45 67', 'Électronique', 1);

-- Prof en attente (accord_dg = 0) – pas encore validé par le DG
INSERT INTO professeurs (nom, prenom, email, password, telephone, specialite, accord_dg) VALUES
('Bamba', 'Fatou', 'bamba.fatou@epi.edu.ci', NULL, '+225 07 55 66 77', 'Mathématiques', 0),
('Coulibaly', 'Jean', 'coulibaly.jean@epi.edu.ci', NULL, '+225 01 88 99 00', 'Physique', 0);

-- ============================================================
-- 4. SALLES
-- ============================================================
INSERT INTO salles (nom, capacite, etat_dispo) VALUES
('Amphi A', 120, 'Disponible'),
('Amphi B', 100, 'Disponible'),
('Salle 101', 40, 'Disponible'),
('Salle 102', 35, 'Disponible'),
('Salle 103', 30, 'Indisponible'),
('Labo Info', 25, 'Disponible'),
('Salle TD1', 20, 'En maintenance');

-- ============================================================
-- 5. ÉTUDIANTS (certains validés, certains en attente)
-- ============================================================
-- Étudiants validés (Filière INFO)
INSERT INTO etudiants (nom, prenom, email, password, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, filiere_id, statut, created_by) VALUES
('Aka', 'Koffi', 'aka.koffi@etu.epi.ci', @hash_pwd, 'Aka Robert', '+225 07 11 22 33', '2003-05-15', '2025-2026', 1, 'Validé', 1),
('Brou', 'Marie', 'brou.marie@etu.epi.ci', @hash_pwd, 'Brou Pierre', '+225 05 44 55 66', '2004-02-20', '2025-2026', 1, 'Validé', 1),
('Yao', 'Ange', 'yao.ange@etu.epi.ci', @hash_pwd, 'Yao Michel', '+225 01 77 88 99', '2003-11-10', '2025-2026', 1, 'Validé', 1),
('N''Guessan', 'Rachelle', 'nguessan.rachelle@etu.epi.ci', @hash_pwd, 'N''Guessan Claude', '+225 07 33 44 55', '2004-08-25', '2025-2026', 1, 'Validé', 1);

-- Étudiants validés (Filière GC)
INSERT INTO etudiants (nom, prenom, email, password, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, filiere_id, statut, created_by) VALUES
('Ouattara', 'Seydou', 'ouattara.seydou@etu.epi.ci', @hash_pwd, 'Ouattara Ali', '+225 05 22 33 44', '2002-07-01', '2025-2026', 2, 'Validé', 1),
('Konan', 'Adjoua', 'konan.adjoua@etu.epi.ci', @hash_pwd, 'Konan François', '+225 01 55 66 77', '2003-01-18', '2025-2026', 2, 'Validé', 1);

-- Étudiants en attente (dossier non encore validé)
INSERT INTO etudiants (nom, prenom, email, password, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, filiere_id, statut) VALUES
('Diomandé', 'Lacina', 'diomande.lacina@etu.epi.ci', NULL, 'Diomandé Paul', '+225 07 66 77 88', '2004-12-03', '2025-2026', 1, 'en attente'),
('Sanogo', 'Fatoumata', 'sanogo.fatoumata@etu.epi.ci', NULL, 'Sanogo Bakary', '+225 05 88 99 00', '2005-03-22', '2025-2026', 3, 'en attente');

-- ============================================================
-- 6. PLANNING COURS (quelques cours planifiés)
-- ============================================================
-- Prof Koné (id supposé = 1) enseigne en INFO
INSERT INTO planning_cours (filiere_id, matiere_id, professeur_id, salle_id, date_cours, heure_debut, heure_fin, created_by) VALUES
(1, 1, 1, 6, '2026-06-16', '08:00', '10:00', 2),  -- Python, Labo Info, Lundi
(1, 2, 1, 1, '2026-06-17', '10:00', '12:00', 2),  -- Réseaux, Amphi A, Mardi
(1, 3, 1, 3, '2026-06-18', '14:00', '16:00', 2);  -- BDD, Salle 101, Mercredi

-- Prof Touré (id supposé = 2) enseigne en GC
INSERT INTO planning_cours (filiere_id, matiere_id, professeur_id, salle_id, date_cours, heure_debut, heure_fin, created_by) VALUES
(2, 6, 2, 1, '2026-06-16', '10:00', '12:00', 2),  -- RDM, Amphi A, Lundi
(2, 8, 2, 2, '2026-06-19', '08:00', '10:00', 2);  -- Béton Armé, Amphi B, Jeudi

-- Prof Diallo (id supposé = 3) enseigne en GE
INSERT INTO planning_cours (filiere_id, matiere_id, professeur_id, salle_id, date_cours, heure_debut, heure_fin, created_by) VALUES
(3, 10, 3, 4, '2026-06-17', '08:00', '10:00', 2), -- Électronique, Salle 102, Mardi
(3, 11, 3, 4, '2026-06-20', '14:00', '16:00', 2); -- Automatisme, Salle 102, Vendredi

-- ============================================================
-- 7. NOTES (quelques notes pour tester les moyennes)
-- ============================================================
-- Notes pour les étudiants INFO (matière Python, id=1)
INSERT INTO notes (etudiant_id, matiere_id, professeur_id, valeur, commentaire, date_evaluation) VALUES
(1, 1, 1, 15.50, 'Très bon travail', '2026-06-01'),
(2, 1, 1, 12.00, 'Peut mieux faire', '2026-06-01'),
(3, 1, 1, 17.25, 'Excellent', '2026-06-01'),
(4, 1, 1, 14.00, 'Bon niveau', '2026-06-01');

-- Notes pour les étudiants INFO (matière Réseaux, id=2)
INSERT INTO notes (etudiant_id, matiere_id, professeur_id, valeur, commentaire, date_evaluation) VALUES
(1, 2, 1, 13.00, 'Assez bien', '2026-06-05'),
(2, 2, 1, 16.50, 'Très bien', '2026-06-05'),
(3, 2, 1, 11.00, 'Insuffisant en pratique', '2026-06-05'),
(4, 2, 1, 14.75, 'Progrès notables', '2026-06-05');

-- Notes pour les étudiants GC (matière RDM, id=6)
INSERT INTO notes (etudiant_id, matiere_id, professeur_id, valeur, commentaire, date_evaluation) VALUES
(5, 6, 2, 16.00, 'Excellente compréhension', '2026-06-03'),
(6, 6, 2, 13.50, 'Bien mais doit approfondir', '2026-06-03');
