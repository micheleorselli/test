<?php

class Logger
{
    private $messages = [];

    public function log(string $log)
    {
        if ($log === '') {
            return;
        }

        $this->messages[] = $log;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}