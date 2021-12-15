<?php

namespace Rendi\Rframework\App\Core\Database;

use Rendi\Rframework\App\Core\Database\Query;

trait DatabaseHelper
{
    protected string $name;
}

class Eloquent extends Query
{

    use DatabaseHelper;

    private ?string $selected = null;
    private ?string $wherev = null;
    private ?string $joinq = null;
    private string $typequery = "SELECT";
    private array $fields;
    private string $table;
    private ?array $value = null;
    private ?array $insertbind = [];

    public function __construct(string $table, array $fields)
    {
        $this->table = $table;
        $this->fields = $fields;
    }

    public function getQueries(string $type): string
    {
        return [
            "SELECT" => "SELECT " . $this->selected . " FROM " . $this->table . ($this->joinq ? $this->joinq : '') . ($this->wherev ? $this->wherev : ''),
            "INSERT" => "INSERT INTO " . $this->table . "(" . join(',', $this->fields) . ") " . "VALUES (" . join(',', $this->insertbind) . ")"
        ][$type];
    }

    public function join(string $join, string $sparator = "=", string $field, string $field2): Eloquent
    {
        return $this;
    }

    private function buildQuery(): string
    {
        $query = "{$this->getQueries($this->typequery)}";
        return $query;
    }

    public function select(...$arguments): Eloquent
    {
        $this->selected = join(',', $arguments) == "" ? "*" : join(',', $arguments);
        return $this;
    }

    public function insert(array $fieldsAndValues): mixed
    {
        $this->typequery = "INSERT";
        $this->insertbind = [];
        $this->setBindInsertValue($fieldsAndValues);
        $query = $this->query($this->buildQuery());
        $this->mapValue($query);
        return $query->execQuery();
    }

    public function setBindInsertValue(array $fieldsAndValues): void
    {
        for ($i = 0; $i < count($this->fields); $i++) {
            $this->value[":{$this->fields[$i]}"] = $fieldsAndValues[$i];
            array_push($this->insertbind, ":{$this->fields[$i]}");
        }
    }

    public function where(string $field, string $sparator = "=", mixed $value): Eloquent
    {
        $this->wherev = " WHERE $field $sparator :$field";
        $this->value = [":$field" => $value];
        return $this;
    }

    public function and(string $field, string $sparator = "=", mixed $value): Eloquent
    {
        $this->wherev ? join(" AND ", [$this->wherev, "$field $sparator :$field"]) : '';
        $this->value ? array_push($this->value, $value) : '';
        return $this;
    }

    public function first(): mixed
    {
        $query = $this->query($this->buildQuery());
        $this->mapValue($query);
        return $query->execQuery()->getSingle();
    }

    public function mapValue(Query $query): void
    {
        if ($this->value != null) {
            foreach ($this->value as $key => $value) {
                $query->bind($key, $value);
            }
        }
    }

    public function get(): ?array
    {
        $query = $this->query($this->buildQuery());
        $this->mapValue($query);
        return $query->execQuery()->getAll();
    }

    public function clearQuery()
    {
        $this->selected = null;
        $this->value = null;
        $this->wherev = null;
    }
}
