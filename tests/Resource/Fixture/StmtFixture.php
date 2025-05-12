<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Factories\StmtFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StmtFixture extends Fixture
{
    public const REFERENCE = 'stmt';

    public function load(ObjectManager $manager, ?array $data = null): void
    {
        $stmt = (new StmtFactory())->create($data);

        $manager->persist($stmt);
        $manager->flush();

        $this->addReference(self::REFERENCE, $stmt);
    }
}
