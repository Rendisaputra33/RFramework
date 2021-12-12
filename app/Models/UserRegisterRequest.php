<?php

namespace Rendi\Rframework\Models;

class UserRegisterRequest
{
    public string $username;
    public string $password;
    public string $confirm;
    public string $hpassword;

    public function __construct(string $username, string $password, string $confirm)
    {
        $this->username = $username;
        $this->password = $password;
        $this->confirm = $confirm;
        $this->hpassword = password_hash($password, PASSWORD_BCRYPT);
    }
}
