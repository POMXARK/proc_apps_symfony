<?php

namespace App\Tests;

use App\Factories\StmtFactory;
use PHPUnit\Framework\TestCase;

class StmtServiceTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function test(): void
    {
        $id = $data['id'] ?? $this->fake()->randomNumber();
        $model = (new StmtFactory())->create();
        $this->setEntityProperty($model, $id, 'id');
        dump($model);

        $this->assertTrue(true);
    }
}
