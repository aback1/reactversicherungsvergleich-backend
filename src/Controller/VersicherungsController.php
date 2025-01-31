<?php

namespace App\Controller;

use App\Repository\VersicherungsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VersicherungsController extends AbstractController
{
    private VersicherungsRepository $versicherungsRepository;

    public function __construct(VersicherungsRepository $versicherungsRepository)
    {
        $this->versicherungsRepository = $versicherungsRepository;
    }

    #[Route('/api/versicherungen', name: 'get_versicherungen', methods: ['GET'])]
    public function getVersicherungen(): JsonResponse
    {
        $versicherungen = $this->versicherungsRepository->findAll();

        $versicherungsarray = array_map(function ($versicherung) {
            return [
                'id' => $versicherung->getId(),
                'name' => $versicherung->getName(),
                'versicherungsbeitrag' => $versicherung->getVersicherungsbeitrag(),
                'zahnleistung' => $versicherung->getZahnleistungen(),
                'osteopathieLeistung' => $versicherung->getOsteopathieLeistungen(),
                'krebsvorsorgeLeistung' => $versicherung->getKrebsvorsorgeleistungen(),
                'homöopathieLeistung' => $versicherung->getHomöopathieleistungen(),
            ];
        }, $versicherungen);

        // Use json_encode() beforehand with the JSON_UNESCAPED_UNICODE option
        $jsonData = json_encode($versicherungsarray, JSON_UNESCAPED_UNICODE);

        // Return the JSON string directly in JsonResponse
        return new JsonResponse($jsonData, 200, [], true); // true indicates $json is true
    }
}
