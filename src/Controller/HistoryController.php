<?php

namespace App\Controller;

use App\Entity\History;
use App\Repository\HistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HistoryController extends AbstractController
{
    private $entityManager;
    private $historyRepository;

    public function __construct(EntityManagerInterface $entityManager, HistoryRepository $historyRepository){
        $this->entityManager = $entityManager; 
        $this->historyRepository = $historyRepository;
    }

    #[Route('/exchange/values', methods: ["GET"], name: 'get')]
    public function index(): JsonResponse
    {
        $history = $this->historyRepository->findAll();

        return $this->json([
            'data' => $history,
            'code' => Response::HTTP_OK
        ]);
    }
    
    #[Route('/exchange/values', methods: ["POST"], name: 'post')]
    public function post(Request $request): JsonResponse
    {
        $jsonData = json_decode($request->getContent(), true);

        $first = $jsonData['first'];
        $second = $jsonData['second'];

        $history = new History();

        $history->setFirstIn($first);
        $history->setSecondIn($second);
        $history->setFirstOut($first);
        $history->setSecondOut($second);
        $history->setCreatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($history);
        $this->entityManager->flush();

        $first = $first ^ $second;  
        $second = $first ^ $second; 
        $first = $first ^ $second;

        $history->setFirstOut($first);
        $history->setSecondOut($second);
        $history->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->flush();

        return $this->json([
            $history, Response::HTTP_CREATED
        ]);
    }
}
