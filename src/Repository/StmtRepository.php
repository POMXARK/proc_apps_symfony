<?php

namespace App\Repository;

use App\Entity\Stmt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stmt>
 *
 * @method Stmt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stmt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stmt[]    findAll()
 * @method Stmt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StmtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stmt::class);
    }
}
