<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected ?int $id = null;

    protected ?string $name;
    protected ?string $password;
    protected ?bool $admin;

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(?bool $admin): void
    {
        $this->admin = $admin;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}