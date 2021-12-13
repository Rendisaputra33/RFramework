<?php

namespace Rendi\Rframework\App\Core\Database;

use Rendi\Rframework\App\Core\Database\Query;

class Eloquent extends Query
{
    protected ?string $querystr;
    protected ?array $selected = null;
    protected ?array $where = null;
    protected ?array $join = null;
    private string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function join(string $join, string $sparator = "=", string $field, string $field2): Eloquent
    {
        $this->querystr = "SELECT " . $this->selected
            ? join(",", $this->selected)
            : "*" . "FROM {$this->table}
            JOIN $join
            ON {$this->table}.$field $sparator $join.$field2";

        return $this;
    }

    private function buildQuery(): string
    {
        return '';
    }

    public function get(): ?array
    {
        return $this->query($this->buildQuery())->execQuery()->getAll();
    }
}
