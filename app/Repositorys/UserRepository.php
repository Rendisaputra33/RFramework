<?php

namespace Rendi\Rframework\Repositorys;

use Rendi\Rframework\Domains\UserDomain;
use Rendi\Rframework\Exceptions\ValidateException;
use Rendi\Rframework\Models\UserRegisterRequest;
use Rendi\Rframework\App\Core\Database\Eloquent;

class UserRepository extends Eloquent
{

    protected string $table_used = "user";
    protected array $fieldable = ['username', 'password'];

    public function __construct()
    {
        parent::__construct($this->table_used, $this->fieldable);
    }

    public function create()
    {
        $this->insert(['rendi', '12345678']);
    }

    public function findByUsername(string $username): ?UserDomain
    {
        try {
            $data = $this->select()->where('username', '=', $username)->first();
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
            $this->insert([$request->username, $request->password]);
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
