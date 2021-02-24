<?php

require __DIR__ . "/../src/Logger.php";

use Logger;

class LoggerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers
     */
    public function test_can_log_a_message()
    {
        $logger = new Logger();

        $logger->log("primo messaggio");
        $logger->log("secondo messaggio");

        $expected = [
            "primo messaggio",
            "secondo messaggio"
        ];

        $this->assertEquals($expected, $logger->getMessages());
    }

    /**
     * @covers
     */
    public function test_an_empty_string_should_not_be_logged()
    {
        $logger = new Logger();

        $logger->log("primo messaggio");
        $logger->log("");

        $expected = [
            "primo messaggio",
        ];

        $this->assertEquals($expected, $logger->getMessages());
    }


}