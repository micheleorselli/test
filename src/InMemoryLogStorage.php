<?php


class InMemoryLogStorage implements LogStorage
{
    private $messages = [];

    public function write(string $log): void
    {
        $this->messages[] = $log;
    }

    public function readAll(): array
    {
        return $this->messages;
    }
}