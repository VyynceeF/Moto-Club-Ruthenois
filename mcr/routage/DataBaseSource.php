<?php 

/**
 * Data base source, élément de connection à la base de données
 */
class DataBaseSource{

    private $host;
    private $port;
    private $db;
    private $user;
    private $pass;

    /**
     * Construction de mes données de connection à ma base de données
     */
    public function __construct($host, $port, $db, $user, $pass){
        $this->host = $host;
        $this->port = $port;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * Création PDO pour ma base de données
     */
    public function getPDO(){
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db";
        $pdo = new PDO($dsn, $this->user, $this->pass);
        return $pdo;
    }
}