<?php

namespace App\Tests;

use App\Entity\Stmt;
use App\Repository\StmtRepository;
use App\Tests\Resource\Fixture\StmtFixture;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\ORMDatabaseTool;

class StmtServiceTest extends AbstractTestCase
{
    private ORMDatabaseTool $databaseTool;
    private StmtRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        putenv('DATABASE_URL=postgres://postgres:12345@127.0.0.1:5432/postgres?sslmode=disable&charset=utf8');
        putenv('SYMFONY_DEPRECATIONS_HELPER=disabled');
        putenv('APP_ENV=test');

        $this->repository = static::getContainer()->get(StmtRepository::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    /**
     * Успешное создание заявки.
     */
    public function testCreateSuccess(): void
    {
        $executor = $this->databaseTool->loadFixtures([StmtFixture::class]);
        /* @var Stmt $stmt */
        $stmt = $executor->getReferenceRepository()->getReference(StmtFixture::REFERENCE);

        /* @var Stmt $existingStmt */
        $existingStmt = $this->repository->find($stmt->getId());

        $this->assertEquals($stmt->getId(), $existingStmt->getId());
    }
}
