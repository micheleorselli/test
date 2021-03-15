<?php

namespace Logger\Storage;

class FileLogStorage implements LogStorage
{
    /**
     * @var string
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        if (file_exists($filePath) && !is_writable($filePath)) {
            throw new \RuntimeException('file non scrivibile');
        }

        if (file_exists($filePath) && !is_readable($filePath)) {
            throw new \RuntimeException('file non leggibile');
        }

        $this->filePath = $filePath;
    }

    public function write(string $log): void
    {
        file_put_contents($this->filePath, $log . "\n", FILE_APPEND);
    }

    public function readAll(): array
    {
        return explode("\n", file_get_contents($this->filePath));
    }
}