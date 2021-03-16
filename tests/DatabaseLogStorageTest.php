<?php

use Logger\Storage\DatabaseLogStorage;
use PHPUnit\Framework\TestCase;

class DatabaseLogStorageTest extends TestCase
{
    public function test_can_log_a_message()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8mb4', 'test', 'test');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec('TRUNCATE logs');

        $logger = new DatabaseLogStorage($pdo);

        $logger->write("primo messaggio");
        $logger->write("secondo messaggio");

        $expected = [
            "primo messaggio",
            "secondo messaggio",
        ];

        $this->assertEquals($expected, $logger->readAll());
    }
}