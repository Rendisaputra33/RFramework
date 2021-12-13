<?php

namespace Rendi\Rframework\Repositorys;

use Rendi\Rframework\Domains\UserDomain;
use Rendi\Rframework\Exceptions\ValidateException;
use Rendi\Rframework\Models\UserRegisterRequest;
use Rendi\Rframework\App\Core\Database\Eloquent;

class UserRepository extends Eloquent
{

    protected $table_used = "user";

    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function findByUsername(string $username): ?UserDomain
    {
        try {
            $query = $this->query("SELECT * FROM user WHERE username = :username");
            $data = $query->bind(':username', $username)->execQuery()->getSingle();
            if ($data) {
                $user = new UserDomain($data);
                return $user;
            }
            return null;
        } finally {
            $this->steatment->closeCursor();
        }
    }

    public function save(UserRegisterRequest $request): bool
    {
        try {
            $query = $this->query("INSERT INTO user (username, password) VALUES (:nama, :pw)");
            $query->bind(':nama', $request->username)->bind(':pw', $request->hpassword)->execQuery();
            return true;
        } catch (\PDOException $exc) {
            if ($exc->getCode() == '23000') {
                throw new ValidateException("username $request->username already exist", 23000);
            } else {
                var_dump($exc->getMessage());
                die();
            }
        }
    }
}
