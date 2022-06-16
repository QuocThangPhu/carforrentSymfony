<?php

namespace App\Transformer;

use App\Entity\Car;

class CarTransformer
{
    public function formArray(Car $car): array
    {
         return [
            'id' => $car->getId(),
            'name' => $car->getName(),
            'description' => $car->getDescription(),
            'color' => $car->getColor(),
            'brand' => $car->getBrand(),
            'price' => $car->getPrice(),
            'seats' => $car->getSeats(),
            'year' => $car->getYear(),
            'thumbnail' => $car->getThumbnail()->jsonParse(),
            'createUser' => $car->getCreatedUser()->jsonParse()
        ];
    }

    public function toArray(array $cars)
    {
        $result = [];
        foreach ($cars as $car) {
            $result = $this->formArray($car);
        }
        return $result;
    }
}