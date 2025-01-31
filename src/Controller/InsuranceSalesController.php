<?php

namespace App\Controller;

use App\Entity\Sale;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InsuranceSalesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/sales', name: 'get_sales', methods: ['GET'])]
    public function getSales(): JsonResponse
    {
        // Fetch all sales records from the database
        $sales = $this->entityManager->getRepository(Sale::class)->findAll();

        // Transform the Sale objects into an array format suitable for JSON response
        $salesArray = array_map(function (Sale $sale) {
            return [
                'id' => $sale->getId(),
                'userID' => $sale->getUserID(),
                'firstname' => $sale->getFirstname(),
                'lastname' => $sale->getLastname(),
                'newInsurance' => $sale->getNewInsurance(),
                'email' => $sale->getEmail(),
                'phonenumber' => $sale->getPhonenumber(),
                'arbeitGeber' => $sale->getArbeitGeber(),
                'habenSieMehrAlsEinenArbeitgeber' => $sale->getMehrAlsEinArbeitgeber(),
                'habenSieVorIhrenArbeitgeberZuWechseln' => $sale->getArbeitgeberWechsel(),
                'sindSieSeit2024angestellt' => $sale->getSeit24angestellt(),
            ];
        }, $sales);

        return $this->json($salesArray, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE]);
    }

    #[Route('/api/sales', name: 'post_sales', methods: ['POST'])]
    public function postSale(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON data'], 400);
        }

        // Validate required fields
        $requiredFields = ['userID', 'firstname', 'lastname', 'newInsurance', 'email', 'phonenumber', 'arbeitGeber', 'habenSieMehrAlsEinenArbeitgeber', 'habenSieVorIhrenArbeitgeberZuWechseln', 'sindSieSeit2024angestellt'];
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                return $this->json(['error' => "Missing field: $field"], 400);
            }
        }

        try {
            $sale = new Sale();
            $sale->setUserID($data['userID']);
            $sale->setFirstname($data['firstname']);
            $sale->setLastname($data['lastname']);
            $sale->setNewInsurance($data['newInsurance']);
            $sale->setEmail($data['email']);
            $sale->setPhonenumber($data['phonenumber']);
            $sale->setArbeitGeber($data['arbeitGeber']);
            $sale->setMehrAlsEinArbeitgeber($data['habenSieMehrAlsEinenArbeitgeber']);
            $sale->setArbeitgeberWechsel($data['habenSieVorIhrenArbeitgeberZuWechseln']);
            $sale->setSeit24angestellt($data['sindSieSeit2024angestellt']);

            $this->entityManager->persist($sale);
            $this->entityManager->flush();

            return $this->json(['message' => 'Sale created successfully'], 201);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Failed to save sale: ' . $e->getMessage()], 500);
        }
    }
}
