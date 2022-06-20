<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Transfer\UpdateWithMethodPutCarTransfer;
use App\Transfer\UpdateWithMethodPatchCarTransfer;

class PatchCarTransferToCar
{
    private ImageRepository $imageRepository;
    private UserRepository $userRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function mapper(Car $car, UpdateWithMethodPatchCarTransfer $updateCarTransfer): Car
    {
        $createdUserId = $updateCarTransfer->getCreatedUserId();
        if ($createdUserId !== null) {
            $createdUser = $this->userRepository->find($createdUserId);
            $car->setCreatedUserId($createdUser);
        }
        $thumbnailId = $updateCarTransfer->getThumbnail();
        if ($thumbnailId !== null) {
            $thumbnail = $this->imageRepository->find($thumbnailId);
            $car->setThumbnailId($thumbnail);
        }

        $car->setName($updateCarTransfer->getName() ?? $car->getName())
            ->setDescription($updateCarTransfer->getDescription() ?? $car->getDescription())
            ->setColor($updateCarTransfer->getColor() ?? $car->getColor())
            ->setBrand($updateCarTransfer->getBrand() ?? $car->getBrand())
            ->setPrice($updateCarTransfer->getPrice() ?? $car->getPrice())
            ->setSeats($updateCarTransfer->getSeats() ?? $car->getSeats())
            ->setYear($updateCarTransfer->getYear() ?? $car->getYear());
        return $car;
    }
}
