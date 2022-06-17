<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Image;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getCarData() as [$id, $name, $description, $color, $brand, $price, $seats, $year]) {
            $now = new \DateTimeImmutable("now");
            $car = new Car();
            /**
             * @var User $createdUser
             */
            $createdUser = $this->getReference('user1');
            /**
             * @var Image $imagePath
             */
            $imagePath = $this->getReference('image' . $id);
            $car->setName($name)
                ->setDescription($description)
                ->setColor($color)
                ->setBrand($brand)
                ->setPrice($price)
                ->setSeats($seats)
                ->setYear($year)
                ->setCreatedAt($now)
                ->setCreatedUserId($createdUser)
                ->setThumbnailId($imagePath);
            $manager->persist($car);
        }
        $manager->flush();
    }

    private function getCarData(): array
    {
        return [
            [1, 'Mercedes C200 Exclusive', 'Mercedes C200 Exclusive Description', 'Red', 'Mercedes', 546, 4, 2020],
            [2, 'Vinfast VF9', 'Vinfast VF9 Description', 'White', 'Vinfast', 457, 7, 2022],
            [3, 'Kia Carens AT', 'Kia Carens AT description', 'Blue', 'Kia', 435, 7, 2019],
            [4, 'Chevrolet Camaro Badge', 'Chevrolet Camaro Badge Description', 'Yellow', 'Chevrolet', 500, 4, 2022],
            [5, 'BMW 4 Series Convertible 2021', 'BMW 4 Series Convertible 2021 Description', 'Green', 'BMW', 700, 4, 2021],
            [6, 'Lamborghini SVJ', 'Lamborghini SVJ description', 'Yellow', 'Lamborghini', 800, 16, 2019],
        ];
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ImageFixtures::class,
        ];
    }
}
