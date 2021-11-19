<?php

namespace Rendi\Rframework\App\Core\Database;

class Config
{
    protected string $username;
    protected string $password;
    protected string $host;
    protected string $db;
    protected string $port;

    public function __construct()
    {
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_SELECTED_NAME'];
        $this->port = $_ENV['DB_PORT'];
    }
}
