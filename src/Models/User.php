<?php

namespace App\Models;

use App\Database;
use PDO;
use PDOStatement;

class User {
    public function __construct(
        public string $name,
        public string $email,
    ) {
        try {
            $this->email = trim($this->email);
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException("Invalid email format");
            }
            $this->name = trim($this->name);
            if (empty($this->name)) {
                throw new \InvalidArgumentException("Name cannot be empty");
            }
            
        } catch (\InvalidArgumentException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function store(): bool|PDOStatement {
        return Database::getInstance()->query("insert into users (name, email) values (:name, :email)", [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }

    public function existsInDatabase(): bool {
        if(Database::getInstance()->fetchOne("select * from users where name = :name, email = :email", ['name' => $this->name, 'email' => $this->email])) {
            return true;
        }
        return false;
    }
}