<?php

class FileLogger
{
    /**
     * @var string
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        if (file_exists($filePath) && !is_writable($filePath)) {
            throw new RuntimeException('file non scrivibile');
        }

        if (file_exists($filePath) && !is_readable($filePath)) {
            throw new RuntimeException('file non leggibile');
        }


        $this->filePath = $filePath;
    }

    public function log(string $log): void
    {
        if ($log === '') {
            return;
        }

        if ($log[0] === 'a') {
            return;
        }

        file_put_contents($this->filePath, $log . "\n", FILE_APPEND);
    }

    public function getLogs(): string
    {
        return file_get_contents($this->filePath);
    }
}