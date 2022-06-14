<?php

namespace App\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/api/profile', name: 'api_profile')]
    #[IsGranted('ROLE_USER')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'home user'
        ]);
    }
}
