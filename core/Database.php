<?php
/**
 * TODO:
 * - Ajouter un pattern Singleton pour éviter les connexions multiples
 * - Ajouter des méthodes utilitaires (query, prepare, etc.)
 * - En production, logger l'erreur au lieu de l'afficher
 */

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    protected $connection;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
