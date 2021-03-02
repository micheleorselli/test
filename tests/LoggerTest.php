<?php

require __DIR__ . '/../src/LogStorage.php';
require __DIR__ . '/../src/InMemoryLogStorage.php';
require __DIR__ . '/../src/Logger.php';

class LoggerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers
     */
    public function test_can_log_a_message()
    {
        $storage = new InMemoryLogStorage();

        $logger = new Logger($storage);

        $logger->log("primo messaggio");
        $logger->log("");
        $logger->log("secondo messaggio");

        $messages = [
            "primo messaggio",
            "secondo messaggio"
        ];

        $this->assertEquals($messages, $storage->readAll());

    }

}