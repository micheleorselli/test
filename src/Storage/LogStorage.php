<?php

namespace Logger\Storage;

interface LogStorage
{
    public function write(string $log): void;

    public function readAll(): array;
}