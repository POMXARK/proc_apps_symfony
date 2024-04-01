<?php

namespace App\Controller;

use App\Entity\Stmt;
use App\Services\StmtService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Контролер заявки.
 */
class StmtController extends AbstractController
{
    public function __construct(
        private readonly StmtService $stmtService,
        private readonly EntityManagerInterface $manager)
    {
    }

    /**
     * Создать заявку.
     */
    #[Route(path: '/api/stmts', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $response = $this->json(['data' => $this->stmtService->create($request->toArray())]);
        $this->manager->flush();

        return $response;
    }

    /**
     * Вернуть заявку.
     */
    #[Route(path: '/api/stmts/{id}', methods: ['GET'])]
    public function show(Stmt $stmt): JsonResponse
    {
        return $this->json(['data' => $stmt]);
    }

    /**
     * Обновить заявку.
     */
    #[Route(path: '/api/stmts/{id}', methods: ['PUT'])]
    public function update(Request $request, Stmt $stmt): JsonResponse
    {
        $response = $this->json(['data' => $this->stmtService->update($stmt, $request->toArray())]);
        $this->manager->flush();

        return $response;
    }

    /**
     * Все заявки.
     */
    #[Route(path: '/api/stmts/', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $response = $this->json(['data' => $this->stmtService->search(
            $request->query->get('status'),
            $request->query->get('created_at'),
            $request->query->get('updated_at'),
        )]);
        $this->manager->flush();

        return $response;
    }

    /**
     * Удалить заявку.
     */
    #[Route(path: '/api/stmts/{id}', methods: ['DELETE'])]
    public function destroy(Stmt $stmt): JsonResponse
    {
        $this->stmtService->delete($stmt);
        $this->manager->flush();

        return $this->json(['status' => true]);
    }
}
