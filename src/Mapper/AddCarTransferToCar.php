<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Entity\User;
use App\Repository\ImageRepository;
use App\Transfer\CarTransfer;
use Symfony\Component\Security\Core\Security;

class AddCarTransferToCar
{
    private ImageRepository $imageRepository;
    private Security $security;

    public function __construct(ImageRepository $imageRepository, Security $security)
    {
        $this->imageRepository = $imageRepository;
        $this->security = $security;
    }

    public function mapper(CarTransfer $carTransfer): Car
    {
        /**
         * @var User $currentUser
         */
        $currentUser = $this->security->getUser();
        $thumbnailId = $carTransfer->getThumbnail();
        $thumbnail = $this->imageRepository->find($thumbnailId);
        $createdAt = new \DateTimeImmutable();
        $car = new Car();
        $car->setName($carTransfer->getName())
            ->setDescription($carTransfer->getDescription())
            ->setColor($carTransfer->getColor())
            ->setBrand($carTransfer->getBrand())
            ->setPrice($carTransfer->getPrice())
            ->setSeats($carTransfer->getSeats())
            ->setYear($carTransfer->getYear())
            ->setCreatedAt($createdAt)
            ->setCreatedUserId($currentUser)
            ->setThumbnailId($thumbnail);
        return $car;
    }
}
