<?php

namespace App\Service;

use App\Mapper\AddRentTransferToRent;
use App\Repository\RentRepository;
use App\Transfer\RentTransfer;

class RentService
{
    private RentRepository $rentRepository;
    private AddRentTransferToRent $rentTransferToRent;

    public function __construct(RentRepository $rentRepository, AddRentTransferToRent $rentTransferToRent)
    {
        $this->rentRepository = $rentRepository;
        $this->rentTransferToRent = $rentTransferToRent;
    }

    public function rentCar(RentTransfer $rentTransfer)
    {
        $rent = $this->rentTransferToRent->mapper($rentTransfer);
        $this->rentRepository->save($rent);

        return $rent;
    }
}
