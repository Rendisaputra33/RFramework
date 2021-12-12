<?php

namespace Rendi\Rframework\App\Domain;


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
        $this->password = $data->password;
        $this->updatedAt = $data->updated_at;
        $this->updatedAt = $data->updated_at;
    }
}
