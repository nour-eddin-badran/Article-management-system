<?php

namespace App\Dtos;

class UserDto
{
    public function __construct(private string $name, private string $email, private string $mobile, private string $password, private int $roleId) { }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }
}