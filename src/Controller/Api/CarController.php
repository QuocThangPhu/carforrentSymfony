<?php

namespace App\Controller\Api;

use App\Entity\Car;
use App\Service\CarService;
use App\Service\UploadFileService;
use App\Traits\ResponseTrait;
use App\Transfer\CarTransfer;
use App\Transfer\FilterTransfer;
use App\Transfer\UpdateWithMethodPutCarTransfer;
use App\Transfer\UpdateWithMethodPatchCarTransfer;
use App\Transformer\CarTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/cars', name: 'car_')]
class CarController extends AbstractController
{
    use ResponseTrait;

    #[Route('/', name: 'list_car', methods: 'GET')]
    public function index(
        Request $request,
        ValidatorInterface $validator,
        FilterTransfer $filterTransfer,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse {
        $query = $request->query->all();
        $filter = $filterTransfer->transfer($query);
        $errors = $validator->validate($filter);
        if (count($errors) > 0) {
            throw new ValidatorException(code: Response::HTTP_BAD_REQUEST);
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
        ValidatorInterface $validator,
        CarService $carService,
        CarTransformer $carTransformer,
        CarTransfer $carTransfer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $car = $carTransfer->transfer($dataRequest);
        $errors = $validator->validate($car);
        if (count($errors) > 0) {
            throw new ValidatorException(code: Response::HTTP_BAD_REQUEST);
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
        ValidatorInterface $validator,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $carRequest = $updateCarTransfer->transfer($dataRequest);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            throw new ValidatorException(code: Response::HTTP_BAD_REQUEST);
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
        ValidatorInterface $validator,
        CarService $carService,
        CarTransformer $carTransformer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $carRequest = $UpdateCarTransfer->transfer($dataRequest);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            throw new ValidatorException(code: Response::HTTP_BAD_REQUEST);
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
