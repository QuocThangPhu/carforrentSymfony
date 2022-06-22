<?php

namespace App\Controller\Api;

use App\Entity\Car;
use App\Service\CarService;
use App\Traits\ResponseTrait;
use App\Transfer\CarTransfer;
use App\Transfer\FilterTransfer;
use App\Transfer\UpdateWithMethodPutCarTransfer;
use App\Transfer\UpdateWithMethodPatchCarTransfer;
use App\Transformer\CarTransformer;
use App\Validator\CarValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/cars', name: 'car_')]
class CarController extends AbstractController
{
    use ResponseTrait;

    #[Route('/', name: 'list_car', methods: 'GET')]
    public function index(
        Request $request,
        CarValidator $carValidator,
        FilterTransfer $filterTransfer,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse {
        $dataRequest = $request->query->all();
        $filter = $filterTransfer->transfer($dataRequest);
        $errors = $carValidator->validatorCarRequest($filter);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $cars = $carService->getCars($filter);
        $results = $carTransformer->toArray($cars);

        return $this->success($results);
    }

    #[Route('/{id}', name: 'car_detail', methods: 'GET')]
    public function carDetails(Car $car, CarTransformer $carTransformer): JsonResponse
    {
        return $this->success($carTransformer->fromArray($car));
    }

    #[Route('/', name: 'add_car', methods: 'POST')]
    #[IsGranted('ROLE_ADMIN')]
    public function addCar(
        Request $request,
        CarValidator $carValidator,
        CarService $carService,
        CarTransformer $carTransformer,
        CarTransfer $carTransfer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $car = $carTransfer->transfer($dataRequest);
        $errors = $carValidator->validatorCarRequest($car);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $car = $carService->addCar($car);
        $result = $carTransformer->fromArray($car);
        return $this->success($result);
    }

    #[Route('/{id}', name: 'put_car', methods: 'PUT')]
    #[IsGranted('ROLE_ADMIN')]
    public function updateWithMethodPutCar(
        Car $car,
        UpdateWithMethodPutCarTransfer $updateCarTransfer,
        Request $request,
        CarValidator $carValidator,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $carRequest = $updateCarTransfer->transfer($dataRequest);
        $errors = $carValidator->validatorCarRequest($carRequest);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $car = $carService->put($car, $carRequest);
        $result = $carTransformer->fromArray($car);
        return $this->success($result);
    }

    #[Route('/{id}', name: 'patch', methods: 'PATCH')]
    #[IsGranted('ROLE_ADMIN')]
    public function updateWithMethodPatchCar(
        Car $car,
        UpdateWithMethodPatchCarTransfer $UpdateCarTransfer,
        Request $request,
        CarValidator $carValidator,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $carRequest = $UpdateCarTransfer->transfer($dataRequest);
        $errors = $carValidator->validatorCarRequest($carRequest);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $car = $carService->patch($car, $carRequest);
        $result = $carTransformer->fromArray($car);
        return $this->success($result);
    }

    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteCar(Car $car, CarService $carService,): JsonResponse
    {
        $carService->deleteCar($car);
        return $this->success([], Response::HTTP_NO_CONTENT);
    }
}
