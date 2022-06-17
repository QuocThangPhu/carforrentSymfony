<?php

namespace App\Service;

use App\Repository\CarRepository;
use App\Request\ListCarRequest;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getCars(ListCarRequest $listCarRequest)
    {
        return $this->carRepository->all($listCarRequest);
    }
}