<?php

namespace App\Factories;

use App\Entity\Stmt;
use App\Traits\FakerTools;

class StmtFactory
{
    use FakerTools;

    /**
     * @throws \ReflectionException
     */
    public function create(?array $data = null): Stmt
    {
        $stmt = (new Stmt())
           ->setName($data['name'] ?? $this->fake()->name)
           ->setEmail($data['email'] ?? $this->fake()->unique()->safeEmail)
           ->setMessage($data['message'] ?? $this->fake()->realText())
        ;

        return $stmt;
    }
}
