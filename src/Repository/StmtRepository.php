<?php

namespace App\Repository;

use App\Entity\Stmt;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function __construct(ManagerRegistry $registry, private readonly EntityManagerInterface $manager)
    {
        parent::__construct($registry, Stmt::class);
    }

    /**
     * Поиск моделей.
     */
    public function search(?string $status, ?string $createdAt, ?string $updatedAt)
    {
        $qb = $this->manager->createQueryBuilder()
            ->select('s')
            ->from(Stmt::class, 's');

        if ($status) {
            $qb->andWhere('s.status = :status')
                ->setParameter('status', $status);
        }
        if ($createdAt) {
            $qb->andWhere('s.created_at > :createdAt')
                ->setParameter('createdAt', Carbon::createFromFormat('Y.m.d', $createdAt.'.01.01'));
        }
        if ($updatedAt) {
            $qb->andWhere('s.updated_at > :updatedAt')
                ->setParameter('updatedAt', Carbon::createFromFormat('Y.m.d', $updatedAt.'.01.01'));
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Создание из массива.
     */
    public function createFromArray(array $data): Stmt
    {
        $stmt = (new Stmt())
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setMessage($data['message'])
            ->setStatus($data['status'] ?? null)
            ->setUpdatedAt(Carbon::now()->toDateTimeImmutable());

        $this->manager->persist($stmt);

        return $stmt;
    }

    /**
     * Обновление из массива.
     */
    public function updateFromArray(Stmt $stmt, array $data): Stmt
    {
        $stmt->setName($data['name'])
            ->setEmail($data['email'])
            ->setMessage($data['message'])
            ->setComment($data['comment'])
            ->setStatus($data['status'])
            ->setUpdatedAt(Carbon::now()->toDateTimeImmutable());

        $this->manager->persist($stmt);

        return $stmt;
    }

    /**
     * Удаление модели.
     */
    public function delete(Stmt $stmt): void
    {
        $this->manager->remove($stmt);
    }
}
