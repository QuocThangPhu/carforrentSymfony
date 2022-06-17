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
            'thumbnail' => $car->getThumbnailId()->jsonParse(),
            'createUser' => $car->getCreatedUserId()->jsonParse()
        ];
    }

    public function toArray(array $cars): array
    {
        $result = [];
        foreach ($cars as $key => $car) {
            $result[$key] = $this->formArray($car);
        }
        return $result;
    }
}