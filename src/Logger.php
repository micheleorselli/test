<?php

class Logger
{
    private $messages = [];

    public function log(string $message)
    {
        if ($message === '') {
            return;
        }

        $this->messages[] = $message;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}