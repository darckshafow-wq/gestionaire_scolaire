<?php
/**
 * ============================================================
 *  CONFIGURATION DE LA BASE DE DONNÉES
 * ============================================================
 * 
 * Ces constantes sont utilisées par core/Database.php pour
 * établir la connexion PDO à MySQL/MariaDB.
 * 
 * 📌 Pour voir vos données en base :
 *    → Ouvrez phpMyAdmin dans votre navigateur :
 *      http://localhost/phpmyadmin
 *    → Connectez-vous avec les identifiants ci-dessous
 *    → Sélectionnez la base "gestion_scolaire"
 * 
 * 🔧 TODO :
 *   - En production, ne JAMAIS laisser les mots de passe en clair ici
 *   - Utiliser des variables d'environnement (.env) ou un fichier hors du dépôt
 */

// --- Paramètres de connexion MySQL ---
define('DB_HOST', 'localhost');           // Serveur de base de données
define('DB_USER', 'admin');               // Nom d'utilisateur MySQL
define('DB_PASS', 'admin123');            // Mot de passe MySQL
define('DB_NAME', 'gestion_scolaire');    // Nom de la base de données
