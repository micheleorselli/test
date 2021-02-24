<?php

class Logger
{
    private $messages = [];

    public function log(string $msg)
    {
        if ($msg === '') {
            return;
        }

        $this->messages[] = $msg;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}