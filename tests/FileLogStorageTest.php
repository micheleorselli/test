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
        if (file_exists('/tmp/prova1.txt')) {
            unlink('/tmp/prova1.txt');
        }

        $logger = new FileLogStorage('/tmp/prova1.txt');

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

        touch('/tmp/prova.txt');
        chmod('/tmp/prova.txt', 0444);

        $logger = new FileLogStorage('/tmp/prova.txt');
    }

    /**
     * @covers
     */
    public function test_throw_error_on_unreadable_filename()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("file non leggibile");

        if (file_exists('/tmp/prova2.txt')) {
            unlink('/tmp/prova2.txt');
        }
        touch('/tmp/prova2.txt');
        chmod('/tmp/prova2.txt', 0222);

        $logger = new FileLogStorage('/tmp/prova2.txt');
    }

}