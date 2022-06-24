<?php

namespace App\Mapper;

use App\Entity\Rent;
use App\Entity\User;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use App\Transfer\RentTransfer;
use Symfony\Component\Security\Core\Security;

class AddRentTransferToRent
{
    const DEFAULT_STATUS = 'processing';
    private Security $security;
    private CarRepository $carRepository;

    public function __construct(
        Security $security,
        CarRepository $carRepository
    ) {
        $this->security = $security;
        $this->carRepository = $carRepository;
    }

    public function mapper(RentTransfer $rentTransfer)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = $this->security->getUser();
        $carId = $rentTransfer->getCarId();
        $car = $this->carRepository->find($carId);
        $createdAt = new \DateTimeImmutable();
        $updatedAt = new \DateTimeImmutable();
        $status = static::DEFAULT_STATUS;
        $rent = new Rent();
        $rent->setUser($currentUser);
        $rent->setCar($car);
        $rent->setStartDate($rentTransfer->getStartDate());
        $rent->setEndDate($rentTransfer->getEndDate());
        $rent->setStatus($status);
        $rent->setCreatedAt($createdAt);
        $rent->setUpdatedAt($updatedAt);

        return $rent;
    }
}
