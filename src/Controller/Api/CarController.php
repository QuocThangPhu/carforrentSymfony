<?php

namespace App\Controller\Api;

use App\Request\ListCarRequest;
use App\Service\CarService;
use App\Traits\ResponseTrait;
use App\Transformer\CarTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/cars', name: 'car_')]
class CarController extends AbstractController
{
    use ResponseTrait;
    #[Route('/', name: 'list_car', methods: 'GET')]
    public function index(
        Request $request,
        ValidatorInterface $validator,
        ListCarRequest $listCarRequest,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse
    {
        $query = $request->query->all();
        $listCarRequest->fromArray($query);
        $validator->validate($listCarRequest);
        $cars = $carService->getCars($listCarRequest);
        $results = $carTransformer->toArray($cars);

        return $this->success($results);
    }
}
