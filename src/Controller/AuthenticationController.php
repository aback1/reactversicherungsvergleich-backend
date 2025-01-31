<?php

namespace App\Controller;

use App\Repository\UserRepository; // Correctly reference the UserRepository
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AuthenticationController extends AbstractController
{
    private $userRepository;
    private $passwordHasher;

    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/api/verifyPassword', methods: ['POST'])]
    public function verifyPassword(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $userId = $data['userId'];
            $password = $data['password'];
            //check in the Repository if the userID is available
            $user = $this->userRepository->find($userId);
            //if the password is not correct return 401 the alert to the user that the password was incorrect is handled in the frontend
            if (!$user || !$this->passwordHasher->isPasswordValid($user, $password)) {
                return new JsonResponse(['success' => false], 401);
            }

            return new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Could not authenticate user'], 500);
        }
    }

}
