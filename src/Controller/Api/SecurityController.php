<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use App\Traits\ResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class SecurityController extends AbstractController
{
    use ResponseTrait;

    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $user = $this->getUser();
        if ($user === null) {
            $message = ['Unauthorized',Response::HTTP_UNAUTHORIZED];
            return $this->error($message);
        }
        $token = $tokenManager->create($user);
        $data = [
            'token' => $token
        ];
        return $this->success($data);
    }
}
