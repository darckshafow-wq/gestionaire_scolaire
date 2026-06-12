-- Migration pour l'architecture 4 rôles

-- 1. Table ETUDIANTS
ALTER TABLE etudiants ADD COLUMN password VARCHAR(255) DEFAULT NULL AFTER email;
ALTER TABLE etudiants ADD COLUMN document_url VARCHAR(255) DEFAULT NULL AFTER photo_url;

-- Pour les étudiants existants (afin qu'ils puissent se connecter s'ils sont 'anciens')
-- Le mot de passe par défaut est 'student123' haché avec bcrypt
UPDATE etudiants SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE password IS NULL AND statut != 'en attente';

-- 2. Table PROFESSEURS
ALTER TABLE professeurs ADD COLUMN password VARCHAR(255) DEFAULT NULL AFTER email;

-- Pour les professeurs existants validés
-- Le mot de passe par défaut est 'prof123' haché avec bcrypt
UPDATE professeurs SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE password IS NULL AND accord_dg = 1;
