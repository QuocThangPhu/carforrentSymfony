<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Entity\User;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Transfer\CarTransfer;
use App\Transfer\UpdateWithMethodPutCarTransfer;
use Symfony\Component\Security\Core\Security;

class PutCarTransferToCar
{
    private ImageRepository $imageRepository;
    private UserRepository $userRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function mapper(Car $car, UpdateWithMethodPutCarTransfer $updateCarTransfer): Car
    {
        $createdUser = $this->userRepository->find($updateCarTransfer->getCreatedUserId());
        $thumbnailId = $updateCarTransfer->getThumbnail();
        $thumbnail = $this->imageRepository->find($thumbnailId);
        $car->setName($updateCarTransfer->getName())
            ->setDescription($updateCarTransfer->getDescription())
            ->setColor($updateCarTransfer->getColor())
            ->setBrand($updateCarTransfer->getBrand())
            ->setPrice($updateCarTransfer->getPrice())
            ->setSeats($updateCarTransfer->getSeats())
            ->setYear($updateCarTransfer->getYear())
            ->setCreatedUserId($createdUser)
            ->setThumbnailId($thumbnail);
        return $car;
    }
}
