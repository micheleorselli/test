<?php

namespace Logger\Storage;

use PDO;

class DatabaseLogStorage implements LogStorage
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function write(string $log): void
    {
        $statement = $this->pdo->prepare("INSERT INTO logs (message) VALUES (:msg)");
        $statement->bindParam(':msg', $log);
        $statement->execute();
    }

    public function readAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM logs");

        return array_column($statement->fetchAll(PDO::FETCH_ASSOC), 'message');
    }
}