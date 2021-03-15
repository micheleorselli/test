<?php

namespace Logger;

use Logger\Storage\LogStorage;

class Logger
{
    /**
     * @var LogStorage
     */
    private $storage;

    public function __construct(LogStorage $storage)
    {
        $this->storage = $storage;
    }

    public function log(string $log): void
    {
        if ($log === '') {
            return;
        }

        if ($log[0] === 'a') {
            return;
        }

        $this->storage->write($log);
    }

    public function getLogs(): array
    {
        return $this->storage->readAll();
    }
}