USE gestion_scolaire;

-- Vidage des tables (Optionnel, au cas où)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE etudiants;
TRUNCATE TABLE administrateurs;
SET FOREIGN_KEY_CHECKS = 1;

-- Insertion de faux administrateurs
-- Mots de passe hashés (ex: 'password123')
INSERT INTO administrateurs (email, pseudo, password) VALUES
('admin@edugest.com', 'SuperAdmin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('secretaire@edugest.com', 'Secretaire', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insertion de faux étudiants
INSERT INTO etudiants (nom, prenom, email, tuteur_nom, tuteur_contact, date_naissance, annee_scolaire, created_by) VALUES
('Dupont', 'Jean', 'jean.dupont@example.com', 'Marie Dupont', '+33 6 12 34 56 78', '2010-05-14', '2026-2027', 1),
('Martin', 'Sophie', 'sophie.martin@example.com', 'Paul Martin', '+33 6 23 45 67 89', '2011-02-28', '2026-2027', 1),
('Bernard', 'Lucas', 'lucas.bernard@example.com', 'Lucie Bernard', '+33 6 34 56 78 90', '2009-11-05', '2026-2027', 2),
('Dubois', 'Emma', 'emma.dubois@example.com', 'Marc Dubois', '+33 6 45 67 89 01', '2010-08-22', '2026-2027', 1),
('Thomas', 'Léo', 'leo.thomas@example.com', 'Claire Thomas', '+33 6 56 78 90 12', '2011-01-10', '2026-2027', 2),
('Robert', 'Chloé', 'chloe.robert@example.com', 'Antoine Robert', '+33 6 67 89 01 23', '2009-04-17', '2026-2027', 1),
('Richard', 'Hugo', 'hugo.richard@example.com', 'Céline Richard', '+33 6 78 90 12 34', '2010-12-03', '2026-2027', 2),
('Petit', 'Inès', 'ines.petit@example.com', 'François Petit', '+33 6 89 01 23 45', '2011-06-30', '2026-2027', 1),
('Durand', 'Arthur', 'arthur.durand@example.com', 'Sylvie Durand', '+33 6 90 12 34 56', '2009-09-11', '2026-2027', 2),
('Leroy', 'Manon', 'manon.leroy@example.com', 'Julien Leroy', '+33 6 01 23 45 67', '2010-03-25', '2026-2027', 1);
