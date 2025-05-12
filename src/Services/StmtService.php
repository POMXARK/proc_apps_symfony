<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Stmt;
use App\Repository\StmtRepository;
use App\Tests\StmtServiceTest;

/**
 * Сервис заявок.
 *
 * @see StmtServiceTest
 */
readonly class StmtService
{
    public function __construct(private StmtRepository $stmtRepository)
    {
    }

    /**
     * Все заявки с фильтрацией по статусу и дате.
     *
     * @return Stmt[]|null
     */
    public function search(?string $status, ?string $createdAt, ?string $updatedAt): ?array
    {
        return $this->stmtRepository->search($status, $createdAt, $updatedAt);
    }

    /**
     * Создание заявки.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Stmt
    {
        return $this->stmtRepository->createFromArray($data);
    }

    /**
     * Ответить на заявку.
     *
     * @param array<string, mixed> $data
     */
    public function update(Stmt $stmt, array $data): Stmt
    {
        $data['status'] = Stmt::STATUS_RESOLVED;

        return $this->stmtRepository->updateFromArray($stmt, $data);
    }

    /**
     * Удалить заявку.
     */
    public function delete(Stmt $stmt): void
    {
        $this->stmtRepository->delete($stmt);
    }
}
