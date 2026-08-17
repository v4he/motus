<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        $path = __DIR__ . '/../motus.db';

        $this->pdo = new PDO('sqlite:' . $path);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $this->initDatabase();
    }

    private function initDatabase()
    {
        $this->pdo->exec("
        CREATE TABLE IF NOT EXISTS words (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            word TEXT NOT NULL UNIQUE
        );

        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            score INTEGER DEFAULT 0
        );
    ");

        $userCount = $this->pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

        if ($userCount == 0) {
            $sql = "INSERT INTO users (username, email, password, score) VALUES 
            ('John', 'john@test.com', 'pass123', 210),
            ('Alex', 'alex@test.com', 'pass123', 150),
            ('Maria', 'maria@test.com', 'pass123', 90),
            ('Paul', 'paul@test.com', 'pass123', 80),
            ('Sophie', 'sophie@test.com', 'pass123', 60),
            ('David', 'david@test.com', 'pass123', 40),
            ('Emma', 'emma@test.com', 'pass123', 20)";

            $this->pdo->exec($sql);
        }





        $count = $this->pdo->query("SELECT COUNT(*) FROM words")->fetchColumn();

        if ($count == 0) {

            $initialWords = file('words.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $stmt = $this->pdo->prepare("INSERT INTO words (word) VALUES (?)");
            foreach ($initialWords as $w) {
                $stmt->execute([trim($w)]);
            }
        }
    }

    public function isWordValid($word)
    {

        $cleanWord = strtolower(trim($word));

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM words WHERE word = ?");
        $stmt->execute([$cleanWord]);

        return $stmt->fetchColumn() > 0;
    }


    public function updateScore($userId)
    {


        $stmt = $this->pdo->prepare('UPDATE users SET score = score + 1 WHERE id = ? RETURNING score');
        $stmt->execute([$userId]);

        $score = $stmt->fetch();


        return $score['score'];
    }

    public function selectScore($userId)
    {
        $stmt = $this->pdo->prepare('SELECT score FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $score = $stmt->fetch();
        return $score['score'];
    }


    public function registerUser($username, $email, $password)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');

        $stmt->execute([$email]);
        $userEmail = $stmt->fetch();

        if ($userEmail !== false) {

            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertStmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?) RETURNING id");

        $insertStmt->execute([$username, $email, $hashedPassword]);
        $userId = $insertStmt->fetch();

        return $userId['id'];
    }

    public function loginUser($email, $password)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');

        $stmt->execute([$email]);
        $userData = $stmt->fetch();



        if ($userData === false) {
            return false;
        }

        $hashedPassword = $userData['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $userData['username'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['userId'] = $userData['id'];


            return true;
        }

        return false;
    }

    public function getRandomWord()
    {
        $stmt = $this->pdo->query("SELECT word FROM words ORDER BY RANDOM() LIMIT 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? strtolower(trim($result['word'])) : 'apple';
    }

    public function getUsers()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users ORDER BY score DESC');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}
