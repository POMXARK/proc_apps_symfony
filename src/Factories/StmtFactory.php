<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entity\Stmt;
use App\Traits\FakerTools;

class StmtFactory
{
    use FakerTools;

    /**
     * @param array<string, mixed>|null $data
     */
    public function create(?array $data = null): Stmt
    {
        $name = isset($data['name']) && is_string($data['name']) ? $data['name'] : $this->fake()->name;
        $email = isset($data['email']) && is_string($data['email']) ? $data['email'] : $this->fake()->unique()->safeEmail;
        $message = isset($data['message']) && is_string($data['message']) ? $data['message'] : $this->fake()->realText();

        return (new Stmt())
            ->setName($name)
            ->setEmail($email)
            ->setMessage($message);
    }
}
