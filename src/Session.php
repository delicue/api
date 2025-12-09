<?php

namespace App;

class Session
{
    protected static $session = [];

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function login(int $id, string $username): void
    {
        $user = Database::getInstance()->fetchOne("select * from users where id = :id and name = :name", ['id' => $id, 'name' => $username]);
        if (!$user) {
            throw new \Exception("User not found");
        }
        self::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ]);
    }
}