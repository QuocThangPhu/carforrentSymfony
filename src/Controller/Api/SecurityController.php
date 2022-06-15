<?php

namespace App\Controller\Api;

use App\Traits\ResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auth', name: 'auth_')]
class SecurityController extends AbstractController
{
    use ResponseTrait;

    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $user = $this->getUser();
        $token = $tokenManager->create($user);
        $data = [
            'token' => $token
        ];
        return $this->success($data);
    }
}
