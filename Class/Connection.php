<?php 

class Connection{

    private PDO $pdo;
    
    public function __construct(){
        $this->pdo = new PDO('mysql:server=localhost;dbname=test', 'admin', 'admin');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getNotes(){
        $stmt = $this->pdo->prepare('SELECT * FROM notes ORDER BY created_at DESC ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addNote(array $note){
        date_default_timezone_set('Asia/Dhaka');

        $stmt = $this->pdo->prepare('INSERT INTO notes (`title`, `description`, `created_at` ) VALUE (:title, :description, :created_at) ');
        $stmt->bindValue('title', $note['title']);
        $stmt->bindValue('description', $note['description']);
        $stmt->bindValue('created_at', date('Y-m-d H:i:sa'));
        return $stmt->execute();
        // echo 'Note added';
        // echo date('Y-m-d h:i:sa');
    }
}