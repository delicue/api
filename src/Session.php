<?php

namespace App;

class Session
{
    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function destroy(): void
    {
        session_unset();
        session_destroy();
    }

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function logout(): void
    {
        self::destroy();
    }

    public static function getUser(): ?array
    {
        return self::get('user');
    }

    public static function register(string $username, string $password): void
    {
        $db = Database::getInstance();
        // Check if user already exists
        $existingUser = $db->fetchOne("select * from users where username = :username", [
            'username' => $username,
        ]);
        if ($existingUser) {
            throw new \Exception("User already exists");
        }
        $db->query("insert into users (username, password) values (:username, :password)", [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        self::login($username, $password);
    }

    public static function login(string $username, $password): void
    {
        try {
            $user = Database::getInstance()->fetchOne("select * from users where username = :username", [
                'username' => $username,
            ]);

            if (!$user) throw new \Exception("User not found");

            if (!password_verify($password, $user['password'])) {
                throw new \Exception("Invalid password");
            }
            
            self::set('user', [
                'username' => $user['username'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Login failed: " . $e->getMessage());
        }

    }
}