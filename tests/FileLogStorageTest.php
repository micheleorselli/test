<?php

use Logger\Storage\FileLogStorage;
use PHPUnit\Framework\TestCase;

class FileLogStorageTest extends TestCase
{
    /**
     * @covers
     */
    public function test_can_log_a_message()
    {
        if (file_exists('./prova1.txt')) {
            unlink('./prova1.txt');
        }

        $logger = new FileLogStorage('./prova1.txt');

        $logger->write("primo messaggio");
        $logger->write("secondo messaggio");

        $expected = [
            "primo messaggio",
            "secondo messaggio",
            ""
        ];

        $this->assertEquals($expected, $logger->readAll());
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

        $logger = new FileLogStorage('./prova.txt');
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

        $logger = new FileLogStorage('./prova2.txt');
    }

}