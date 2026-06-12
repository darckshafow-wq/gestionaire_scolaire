-- ============================================================
--  DONNÉES FACTICES - Pour tests et démonstration
-- ============================================================
--  ⚠️  Exécuter APRÈS data/schema.sql
-- ============================================================

USE gestion_scolaire;

-- Vidage des tables
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE etudiants;
TRUNCATE TABLE filieres;
TRUNCATE TABLE administrateurs;
SET FOREIGN_KEY_CHECKS = 1;

-- Insertion de faux administrateurs
-- Mot de passe : password123
INSERT INTO administrateurs (email, pseudo, password) VALUES
('admin@epi.edu.ci', 'SuperAdmin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('secretaire@epi.edu.ci', 'Secretaire', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insertion des filières
INSERT INTO filieres (code, nom, description, duree_annees, niveau, statut) VALUES
('INFO', 'Informatique et Réseaux', 'Formation en développement logiciel, réseaux et systèmes informatiques.', 3, 'Licence', 'Active'),
('GC', 'Génie Civil', 'Formation en conception et construction d''ouvrages de génie civil.', 3, 'Licence', 'Active'),
('GE', 'Génie Électrique', 'Formation en électronique, électrotechnique et automatisme.', 3, 'Licence', 'Active'),
('GM', 'Génie Mécanique', 'Formation en conception mécanique et maintenance industrielle.', 3, 'Licence', 'Active'),
('MKT', 'Marketing et Commerce', 'Formation en stratégie commerciale, marketing digital et vente.', 3, 'Licence', 'Active'),
('CG', 'Comptabilité et Gestion', 'Formation en comptabilité, finance et gestion d''entreprise.', 2, 'BTS', 'Active');

-- Insertion de faux étudiants (avec filiere_id)
INSERT INTO etudiants (nom, prenom, email, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, filiere_id, created_by) VALUES
('Dupont', 'Jean', 'jean.dupont@example.com', 'Marie Dupont', '+33 6 12 34 56 78', '2010-05-14', '2026-2027', 1, 1),
('Martin', 'Sophie', 'sophie.martin@example.com', 'Paul Martin', '+33 6 23 45 67 89', '2011-02-28', '2026-2027', 2, 1),
('Bernard', 'Lucas', 'lucas.bernard@example.com', 'Lucie Bernard', '+33 6 34 56 78 90', '2009-11-05', '2026-2027', 1, 2),
('Dubois', 'Emma', 'emma.dubois@example.com', 'Marc Dubois', '+33 6 45 67 89 01', '2010-08-22', '2026-2027', 3, 1),
('Thomas', 'Léo', 'leo.thomas@example.com', 'Claire Thomas', '+33 6 56 78 90 12', '2011-01-10', '2026-2027', 4, 2),
('Robert', 'Chloé', 'chloe.robert@example.com', 'Antoine Robert', '+33 6 67 89 01 23', '2009-04-17', '2026-2027', 1, 1),
('Richard', 'Hugo', 'hugo.richard@example.com', 'Céline Richard', '+33 6 78 90 12 34', '2010-12-03', '2026-2027', 5, 2),
('Petit', 'Inès', 'ines.petit@example.com', 'François Petit', '+33 6 89 01 23 45', '2011-06-30', '2026-2027', 6, 1),
('Durand', 'Arthur', 'arthur.durand@example.com', 'Sylvie Durand', '+33 6 90 12 34 56', '2009-09-11', '2026-2027', 2, 2),
('Leroy', 'Manon', 'manon.leroy@example.com', 'Julien Leroy', '+33 6 01 23 45 67', '2010-03-25', '2026-2027', 1, 1);
