<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/api/users', name: 'get_users', methods: ['GET'])]
    public function getUsers(): JsonResponse
    {
        // Fetch all users from the database
        $users = $this->userRepository->findAll();

        // Transform users into an array
        $userArray = array_map(function ($user) {
            return [
                'id' => $user->getId(),
                'name' => $user->getName(),
/*                'password' => $user->getPassword()*/
            ];
        }, $users);

        // Return the JSON response
        return new JsonResponse($userArray, 200);
    }

    #[Route('/api/users', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        // Parse JSON request body
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        if (empty($data['id']) || empty($data['name']) || empty($data['password'])) {
            return new JsonResponse(['error' => 'ID, name, and password are required'], 400);
        }

        // Create and populate User entity
        $user = new User();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        // Save the user to the database
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Return success response
        return new JsonResponse(['message' => 'User created successfully'], 201);
    }
}
