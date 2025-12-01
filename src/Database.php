<?php

namespace Api;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private static $instance;
    private PDO $connection;

    private function __construct($dsn)
    {
        try {
            $this->connection = new PDO("sqlite:{$dsn}", options: [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $exception) {
            die("Error: {$exception->getMessage()}");
        }
    }

    public static function getInstance()
    {
        return static::$instance;
    }

    public static function config(string $dsn)
    {
        static::$instance = new self($dsn);
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    public function fetch($query, $params = [])
    {
        return self::query($query, $params)->fetch();
    }

    public function fetchAll($query, $params = [])
    {
        return self::query($query, $params)->fetchAll();
    }

    /**
     * Creates a new table in the database, automatically including an `id` column in the table.
     * @param string $table
     * @param array $columns
     * @return void
     */
    public function createTable(string $table, $columns): bool|PDOStatement {
        $statement = self::query("CREATE TABLE IF NOT EXISTS :table (:columns)", [
            ':table' => $table,
            ':columns' => implode(', ', $columns)
        ]);

        return $statement;
    }

    public function count($table): int {
        $result = self::fetchOne("SELECT COUNT(*) as count FROM :table", [$table]);
        return $result ? (int)$result['count'] : 0;
    }

    public function isValidApiKey($apiKey)
    {
        $stmt = $this->connection->prepare('SELECT COUNT(*) FROM api_keys WHERE api_key = :api_key');
        $stmt->bindParam(':api_key', $apiKey);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Finds a single record from the database.
     *
     * @param [type] $query
     * @param array $params
     * @return array|null
     */
    public function fetchOne($query, $params = []): ?array {
        $stmt = self::query($query, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }
}