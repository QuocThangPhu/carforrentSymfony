<?php

namespace App\Controller\Api;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auth', name: 'auth_')]
class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $user = $this->getUser();
        if ($user === null) {

            return $this->json([
                'status' => 'error',
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $token = $tokenManager->create($user);
        return $this->json([
            'status' => 'success',
            'data' => [
                'user' => $user->getUserIdentifier(),
                'roles' => $user->getRoles(),
                'token' => $token
            ]
        ]);
    }
}
