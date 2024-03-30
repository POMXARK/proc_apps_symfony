<?php

namespace App\Tests;

use App\Factories\StmtFactory;
use PHPUnit\Framework\TestCase;

class StmtServiceTest extends TestCase
{
    public function test(): void
    {
        $model = (new StmtFactory())->create();
        dump($model);
        $this->assertEquals(true, true);
    }
}
