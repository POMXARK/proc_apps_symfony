<?php

declare(strict_types=1);

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
     *
     * @return Stmt[]|null
     */
    public function search(?string $status, ?string $createdAt, ?string $updatedAt): ?array
    {
        $qb = $this->manager->createQueryBuilder()
            ->select('s')
            ->from(Stmt::class, 's');

        if (null !== $status) {
            $qb->andWhere('s.status = :status')
                ->setParameter('status', $status);
        }
        if (null !== $createdAt) {
            $qb->andWhere('s.created_at > :createdAt')
                ->setParameter('createdAt', Carbon::createFromFormat('Y.m.d', $createdAt.'.01.01'));
        }
        if (null !== $updatedAt) {
            $qb->andWhere('s.updated_at > :updatedAt')
                ->setParameter('updatedAt', Carbon::createFromFormat('Y.m.d', $updatedAt.'.01.01'));
        }

        $result = $qb->getQuery()->getResult();

        // Убедитесь, что результат является массивом объектов Stmt
        if (is_array($result)) {
            return $result; // Возвращаем массив объектов Stmt
        }

        return null; // Возвращаем null, если результат не массив
    }

    /**
     * Создание из массива.
     *
     * @param array<string, mixed> $data
     */
    public function createFromArray(array $data): Stmt
    {
        $stmt = new Stmt();

        // Проверка и приведение типов
        $data = $this->getData($data, $stmt);
        if (isset($data['status']) && is_string($data['status'])) {
            $stmt->setStatus($data['status']);
        } else {
            $stmt->setStatus(null);
        }

        $this->manager->persist($stmt);

        return $stmt;
    }

    /**
     * Обновление из массива.
     *
     * @param array<string, mixed> $data
     */
    public function updateFromArray(Stmt $stmt, array $data): Stmt
    {
        // Проверка и приведение типов
        $data = $this->getData($data, $stmt);
        if (isset($data['comment']) && is_string($data['comment'])) {
            $stmt->setComment($data['comment']);
        } else {
            $stmt->setComment(null);
        }
        if (isset($data['status']) && is_string($data['status'])) {
            $stmt->setStatus($data['status']);
        } else {
            $stmt->setStatus(null);
        }

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

    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    private function getData(array $data, Stmt $stmt): array
    {
        if (isset($data['name']) && is_string($data['name'])) {
            $stmt->setName($data['name']);
        }
        if (isset($data['email']) && is_string($data['email'])) {
            $stmt->setEmail($data['email']);
        }
        if (isset($data['message']) && is_string($data['message'])) {
            $stmt->setMessage($data['message']);
        }

        return $data;
    }
}
