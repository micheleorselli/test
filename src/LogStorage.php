<?php


interface LogStorage
{
    public function write(string $log): void;

    public function readAll(): array;
}