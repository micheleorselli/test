<?php

namespace Test;

use Logger\Logger;
use Logger\Storage\InMemoryLogStorage;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
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

    /**
     * @covers
     */
    public function test_can_log_message_on_multiple_storage()
    {
        $storage1 = new InMemoryLogStorage();
        $storage2 = new InMemoryLogStorage();
        $storage3 = new InMemoryLogStorage();

        $combinedStorage = new \Logger\Storage\CombinedLogStorage([$storage1, $storage2, $storage3]);

        $logger = new Logger($combinedStorage);

        $logger->log("primo messaggio");
        $logger->log("");
        $logger->log("secondo messaggio");

        $messages = [
            "primo messaggio",
            "secondo messaggio"
        ];

        $this->assertEquals($messages, $combinedStorage->readAll());

    }


    /**
     * @covers
     */
    public function test_can_log_message_on_multiple_storage_2()
    {
        $storage1 = new InMemoryLogStorage();
        $storage2 = new InMemoryLogStorage();
        $storage3 = new InMemoryLogStorage();

        $combinedStorage = new \Logger\Storage\CombinedLogStorage([$storage1, $storage2, $storage3]);

        $combinedStorage->write("un messaggio");

        $this->assertEquals(["un messaggio"], $storage1->readAll());
        $this->assertEquals(["un messaggio"], $storage2->readAll());
        $this->assertEquals(["un messaggio"], $storage3->readAll());

        $this->assertEquals(["un messaggio"], $combinedStorage->readAll());
    }






}