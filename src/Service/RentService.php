<?php

namespace App\Service;

use App\Mapper\AddRentTransferToRent;
use App\Repository\RentRepository;
use App\Transfer\RentTransfer;

class RentService
{
    private RentRepository $rentRepository;
    private AddRentTransferToRent $addRentTransferToRent;

    public function __construct(RentRepository $rentRepository, AddRentTransferToRent $addRentTransferToRent)
    {
        $this->rentRepository = $rentRepository;
        $this->addRentTransferToRent = $addRentTransferToRent;
    }

    public function rentCar(RentTransfer $rentTransfer)
    {
        $rent = $this->addRentTransferToRent->mapper($rentTransfer);
        $this->rentRepository->save($rent);

        return $rent;
    }
}