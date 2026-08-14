<?php

class Database {
    private $pdo;

    public function __construct() {
        $path = __DIR__ . '/../motus.db';
        
        $this->pdo = new PDO('sqlite:' . $path);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
     
        $this->initDatabase();
    }

    private function initDatabase() {
     
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS words (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                word TEXT NOT NULL UNIQUE
            );

            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                score INTEGER DEFAULT 0
            );
        ");

        
        $count = $this->pdo->query("SELECT COUNT(*) FROM words")->fetchColumn();

        if ($count == 0) {
            $initialWords = ['apple', 'table', 'melon', 'house', 'water', 'lemon', 'bread'];
            $stmt = $this->pdo->prepare("INSERT INTO words (word) VALUES (?)");
            foreach ($initialWords as $w) {
                $stmt->execute([$w]);
            }
        }
    }

    public function isWordValid($word) {
  
    $cleanWord = strtolower(trim($word));

    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM words WHERE word = ?");
    $stmt->execute([$cleanWord]);
     
    return $stmt->fetchColumn() > 0;
}


   public function getRandomWord() {
    $stmt = $this->pdo->query("SELECT word FROM words ORDER BY RANDOM() LIMIT 1");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? strtolower(trim($result['word'])) : 'apple';
}
}