<?php

namespace App\Controller\Api;


use App\Service\ImageService;
use App\Traits\ResponseTrait;
use App\Transformer\ImageTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/images', name: 'image_')]
class ImageController extends AbstractController
{
    use ResponseTrait;
    #[Route('/', name: 'add_image', methods: 'POST')]
    public function addImage(
        Request $request,
        ImageService $imageService,
        ImageTransformer $imageTransformer
    ): JsonResponse
    {
        $fileRequest = $request->files->get('image');
        $image = $imageService->addImage($fileRequest);
        $results = $imageTransformer->fromArray($image);

        return $this->success($results);
    }
}
