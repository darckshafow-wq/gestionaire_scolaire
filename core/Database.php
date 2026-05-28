<?php
/**
 * ============================================================
 *  CLASSE DATABASE - Connexion PDO à MySQL
 * ============================================================
 * 
 * Gère la connexion à la base de données MySQL via PDO.
 * Les constantes DB_HOST, DB_USER, DB_PASS, DB_NAME sont
 * définies dans config/config.php.
 * 
 * ✅ FAIT :
 *   - Connexion PDO avec charset UTF-8
 *   - Mode d'erreur EXCEPTION activé
 *   - Méthode getConnection() pour récupérer l'objet PDO
 * 
 * 🔧 À FAIRE (TODO) :
 *   - Ajouter un pattern Singleton pour éviter les connexions multiples
 *   - Ajouter des méthodes utilitaires (query, prepare, etc.)
 */

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    protected $connection;

    /**
     * Constructeur : établit la connexion PDO
     */
    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            // Active le mode exception pour mieux gérer les erreurs SQL
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // TODO: En production, logger l'erreur au lieu de l'afficher
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    /**
     * Retourne l'objet PDO pour effectuer des requêtes
     * Utilisé par les modèles (Admin, Etudiant, etc.)
     * 
     * @return PDO
     */
    public function getConnection() {
        return $this->connection;
    }
}
