<?php

require __DIR__ . '/../src/FileLogger.php';

class FileLoggerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers
     */
    public function test_can_log_a_message()
    {
        if (file_exists('./prova1.txt')) {
            unlink('./prova1.txt');
        }

        $logger = new FileLogger('./prova1.txt');

        $logger->log("primo messaggio");
        $logger->log("secondo messaggio");

        $expected = "primo messaggio\nsecondo messaggio\n";

        $this->assertEquals($expected, $logger->getLogs());
    }

    /**
     * @covers
     */
    public function test_throw_error_on_unwriteable_filename()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("file non scrivibile");

        touch('./prova.txt');
        chmod('./prova.txt', 0444);

        $logger = new FileLogger('./prova.txt');
    }

    /**
     * @covers
     */
    public function test_throw_error_on_unreadable_filename()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("file non leggibile");

        if (file_exists('./prova2.txt')) {
            unlink('./prova2.txt');
        }
        touch('./prova2.txt');
        chmod('./prova2.txt', 0222);

        $logger = new FileLogger('./prova2.txt');
    }

}