<?php

namespace App\Factories;

use App\Entity\Stmt;
use App\Traits\FakerTools;

class StmtFactory
{
    use FakerTools;

    public function create(?array $data = null): Stmt
    {
        return (new Stmt())
            ->setId($data['id'] ?? $this->fake()->randomNumber())
            ->setName($data['name'] ?? $this->fake()->name)
            ->setEmail($data['email'] ?? $this->fake()->unique()->safeEmail)
            ->setMessage($data['message'] ?? $this->fake()->realText())
            ;
    }
}
