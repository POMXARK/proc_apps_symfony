<?php

namespace App\Traits;

use Faker\Factory;
use Faker\Generator;

trait FakerTools
{
    public function fake(): Generator
    {
        return Factory::create();
    }
}