<?php

namespace App\Controller\Api;

use App\Request\ListCarRequest;
use App\Service\CarService;
use App\Traits\ResponseTrait;
use App\Transformer\CarTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarController extends AbstractController
{
    use ResponseTrait;
    #[Route('/api/car_list', name: 'api_car_list', methods: 'GET')]
    public function carList(
        Request $request,
        ValidatorInterface $validator,
        ListCarRequest $listCarRequest,
        CarService $carService,
        CarTransformer $carTransformer
    )
    {
        $query = $request->query->all();
        $listCarRequest->fromArray($query);
        $validator->validate($listCarRequest);
        $cars = $carService->getCars($listCarRequest);
        $results = $carTransformer->toArray($cars);

        return $this->success($results);
    }
}
