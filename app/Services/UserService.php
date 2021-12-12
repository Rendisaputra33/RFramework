<?php

namespace Rendi\Rframework\Services;

use Rendi\Rframework\App\Core\Database\Database;
use Rendi\Rframework\Exceptions\ValidateException;
use Rendi\Rframework\Models\UserLoginRequest;
use Rendi\Rframework\Models\UserRegisterRequest;
use Rendi\Rframework\Repositorys\UserRepository;

class UserService
{
    public ?UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function login(UserLoginRequest $loginRequest)
    {
        try {
            // fetch user by username
            $user = $this->repository->findByUsername($loginRequest->username);
            // when user not found
            if (!$user) throw new ValidateException('user not found');
            // when password valid return user
            if (password_verify($loginRequest->password, $user->password)) return $user;
            throw new ValidateException('username or password wrong!');
        } catch (\Exception $e) {
            var_dump($e);
            die();
        }
    }

    public function register(UserRegisterRequest $registerRequest): bool
    {
        try {
            Database::beginTransaction();
            $user = $this->repository->save($registerRequest);
            Database::commitTransaction();
            return $user;
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            var_dump($e->getMessage());
            return false;
        }
    }
}
