<?php

\Dotenv\Dotenv::createImmutable(__DIR__ . '/../../')->load();

use Rendi\Rframework\App\Core\Database\Query;

class Schema extends Query
{
    private ?array $queries;

    public function string(string $name): void
    {
        array_push($this->queries, $name);
    }
}
