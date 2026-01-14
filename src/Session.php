<?php

namespace App;

use Exception;
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
        return isset($_SESSION['username']);
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
        try {
            $db = Database::getInstance();
            // Check if user already exists
            $existingUser = $db->fetchOne("select * from users where username = :username", [
                'username' => $username,
            ]);
            if ($existingUser) {
                throw new Exception("User already exists");
            }
            $db->query("insert into users (username, password) values (:username, :password)", [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
            self::login($username, $password);
        } catch (Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }

    public static function login(string $username, $password): string|bool
    {
        try {
            $user = Database::getInstance()->fetchOne("select * from users where username = :username", [
                'username' => $username,
            ]);

            if (!$user) throw new Exception("User not found");

            if (!password_verify($password, $user['password'])) {
                throw new Exception("Invalid password");
            }
            
            self::set('user', [
                'username' => $user['username'],
            ]);
            return json_encode(['success' => true]);
            
        } catch (Exception $e) {
            http_response_code(401);
            return json_encode(['success' => false, 'message' => "Login failed: " . $e->getMessage()]);
        }
    }
}