<?php

namespace Rendi\Rframework\App\Core\Database;

use Rendi\Rframework\App\Core\Database\Database;

interface QueryInterface
{
    public function query(string $query): Query;
    public function bind(string $key, $value, $type): Query;
    public function execQuery(): Query;
    public function getSingle(): mixed;
    public function getAll(): array;
}

class Query extends Database implements QueryInterface
{
    protected \PDOStatement $steatment;

    // prepare the steatment
    public function query(string $query): Query
    {
        $connection = Database::getConnection(null);
        $this->steatment = $connection->prepare($query);
        return $this;
    }

    // binding value
    public function bind(string $key, $value, $type = null): Query
    {
        $bind = $this->setBinding($key, $value, $type);

        $this->steatment->bindValue($bind['k'], $bind['v'], $bind['t']);

        return $this;
    }

    // execute query
    public function execQuery(): Query
    {
        $this->steatment->execute();
        return $this;
    }

    // get single data
    public function getSingle(): mixed
    {
        return $this->steatment->fetch(\PDO::FETCH_OBJ);
    }

    // get all data as array
    public function getAll(): array
    {
        return $this->steatment->fetchAll(\PDO::FETCH_OBJ);
    }
}
