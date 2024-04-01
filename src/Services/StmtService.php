<?php

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
     */
    public function search(?string $status, ?string $createdAt, ?string $updatedAt)
    {
        return $this->stmtRepository->search($status, $createdAt, $updatedAt);
    }

    /**
     * Создание заявки.
     */
    public function create(array $data): Stmt
    {
        return $this->stmtRepository->createFromArray($data);
    }

    /**
     * Ответить на заявку.
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
