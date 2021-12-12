<?php

namespace Rendi\Rframework\App\Repository;

use Rendi\Rframework\App\Core\Database\Query;
use Rendi\Rframework\App\Domain\UserDomain;
use Rendi\Rframework\App\Models\UserRegisterRequest;

class UserRepository extends Query
{
    public function findByUsername(string $username): ?UserDomain
    {
        try {
            $query = $this->query("SELECT * FROM user WHERE username = :username");
            $data = $query->bind(':username', $username)->execQuery()->getSingle();
            if ($data !== null) {
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
            $query = $this->query("INSERT INTO user (id, username, password) VALUES ('', :nama, :pw)");
            $query->bind(':nama', $request->username)->bind(':pw', $request->password)->execQuery();
            return true;
        } catch (\PDOException $exc) {
            var_dump($exc->getMessage());
            die();
        }
    }
}
