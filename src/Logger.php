<?php

class Logger
{
    private $msgs = [];

    public function log(string $msg)
    {
        if ($msg === '') {
            return;
        }

        $this->msgs[] = $msg;
    }

    public function getMessages(): array
    {
        return $this->msgs;
    }
}