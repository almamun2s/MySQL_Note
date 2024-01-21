<?php 

class Connection{

    private PDO $pdo;
    
    public function __construct(){
        $this->pdo = new PDO('mysql:server=localhost;dbname=test', 'admin', 'admin');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getNotes(){
        $stmt = $this->pdo->prepare('SELECT * FROM notes');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}