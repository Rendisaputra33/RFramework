<?php

namespace Rendi\Rframework\Domains;


class UserDomain
{
    public ?string $username;
    public ?int $id_user;
    public ?string $password;
    public ?string $createdAt;
    public ?string $updatedAt;

    public function __construct(mixed $data)
    {
        $this->username = $data->username;
        $this->id_user = $data->id;
        $this->password = strlen($data->password) < 30 ? password_hash($data->password, PASSWORD_BCRYPT) : $data->password;
        $this->createdAt = $data->created_at;
        $this->updatedAt = $data->updated_at;
    }
}
