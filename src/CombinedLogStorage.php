<?php


namespace Logger;


class CombinedLogStorage implements \LogStorage
{
    private $logStorage;

    public function __construct(array $logStorage)
    {
        $this->logStorage = $logStorage;
    }

    public function write(string $log): void
    {
        foreach ($this->logStorage as $storage)
        {
            $storage->write($log);
        }
    }

    public function readAll(): array
    {
        return $this->logStorage[0]->readAll();
    }
}