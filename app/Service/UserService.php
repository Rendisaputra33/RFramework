<?php

namespace Rendi\Rframework\App\Service;

use Rendi\Rframework\App\Core\Database\Database;
use Rendi\Rframework\App\Exception\ValidationException;
use Rendi\Rframework\App\Models\UserLoginRequest;
use Rendi\Rframework\App\Models\UserRegisterRequest;
use Rendi\Rframework\App\Repository\UserRepository;

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
            if (!$user) throw new ValidationException('user not found');
            // when password valid return user
            if (password_verify($loginRequest->password, $user->password)) return $user;
            throw new ValidationException('username or password wrong!');
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
            return $user;
            Database::commitTransaction();
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            var_dump($e->getMessage());
        }
    }
}
