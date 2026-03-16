<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'analytics_db';
    private $username = 'collector_user';
    private $password = 'YourSecurePassword123!';

    public function connect() {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}