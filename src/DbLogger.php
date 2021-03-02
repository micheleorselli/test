<?php

class DbLogger
{

    /**
     * @var DB
     */
    private $db;

    public function __construct(DB $db)
    {

        $this->db = $db;
    }

    public function log(string $log): void
    {
        if ($log === '') {
            return;
        }

        if ($log[0] === 'a') {
            return;
        }

        $this->db->insert($log);
    }

    public function getLogs(): string
    {
        return $this->db->findAll();
    }
}