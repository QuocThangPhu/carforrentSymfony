<?php

namespace App\Service;

use App\Entity\Car;
use App\Mapper\AddCarTransferToCar;
use App\Mapper\PutCarRequestToCar;
use App\Repository\CarRepository;
use App\Transfer\CarTransfer;
use App\Transfer\FilterTransfer;
use App\Transfer\UpdateCarTransfer;

class CarService
{
    private CarRepository $carRepository;
    private AddCarTransferToCar $carTransferToCar;
    private PutCarRequestToCar $putCarRequestToCar;

    public function __construct(
        CarRepository $carRepository,
        AddCarTransferToCar $carTransferToCar,
        PutCarRequestToCar $putCarRequestToCar
    ) {
        $this->carRepository = $carRepository;
        $this->carTransferToCar = $carTransferToCar;
        $this->putCarRequestToCar = $putCarRequestToCar;
    }

    public function getCars(FilterTransfer $filterTransfer)
    {
        return $this->carRepository->all($filterTransfer);
    }

    public function addCar(CarTransfer $carTransfer): Car
    {
        $car = $this->carTransferToCar->mapper($carTransfer);
        $this->carRepository->save($car);
        return $car;
    }

    public function put(Car $car, UpdateCarTransfer $updateCarTransfer): Car
    {
        $updatedCar = $this->putCarRequestToCar->mapper($car, $updateCarTransfer);
        $this->carRepository->save($updatedCar);
        return $car;
    }

    public function deleteCar(Car $car): void
    {
        $this->carRepository->remove($car);
    }
}
