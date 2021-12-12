<?php

namespace Rendi\Rframework\App\Models;

class UserRegisterRequest
{
    public string $username;
    public string $password;
    public string $confirm;

    public function __construct(string $username, string $password, string $confirm)
    {
        $this->username = $username;
        $this->password = $password;
        $this->confirm = $confirm;
    }
}
