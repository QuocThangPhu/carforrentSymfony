<?php

namespace App\Service;

use App\Entity\Car;
use App\Mapper\AddCarTransferToCar;
use App\Mapper\PatchCarTransferToCar;
use App\Mapper\PutCarTransferToCar;
use App\Repository\CarRepository;
use App\Transfer\CarTransfer;
use App\Transfer\FilterTransfer;
use App\Transfer\UpdateWithMethodPutCarTransfer;
use App\Transfer\UpdateWithMethodPatchCarTransfer;

class CarService
{
    private CarRepository $carRepository;
    private AddCarTransferToCar $carTransferToCar;
    private PutCarTransferToCar $putCarTransferToCar;
    private PatchCarTransferToCar $patchCarTransferToCar;

    public function __construct(
        CarRepository $carRepository,
        AddCarTransferToCar $carTransferToCar,
        PutCarTransferToCar $putCarTransferToCar,
        PatchCarTransferToCar $patchCarTransferToCar
    ) {
        $this->carRepository = $carRepository;
        $this->carTransferToCar = $carTransferToCar;
        $this->putCarTransferToCar = $putCarTransferToCar;
        $this->patchCarTransferToCar = $patchCarTransferToCar;
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

    public function put(Car $car, UpdateWithMethodPutCarTransfer $updateCarTransfer): Car
    {
        $updatedCar = $this->putCarTransferToCar->mapper($car, $updateCarTransfer);
        $this->carRepository->save($updatedCar);
        return $car;
    }

    public function patch(Car $car, UpdateWithMethodPatchCarTransfer $updateCarTransfer): Car
    {
        $updatedCar = $this->patchCarTransferToCar->mapper($car, $updateCarTransfer);
        $this->carRepository->save($updatedCar);
        return $car;
    }

    public function deleteCar(Car $car): void
    {
        $this->carRepository->remove($car);
    }
}
