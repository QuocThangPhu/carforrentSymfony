<?php

namespace App\Transformer;

use App\Entity\Car;

class CarTransformer extends BaseTransformer
{
    const PARAMS = ['id' ,'name' ,'description' ,'color' ,'brand' ,'price' ,'seats' ,'year'];
    public function fromArray(Car $car): array
    {
        $result = $this->transform($car, static::PARAMS);
        $result['thumbnail'] = $car->getThumbnailId()->jsonParse();
        $result['createUser'] = $car->getCreatedUserId()->jsonParse();

        return $result;
    }

    public function toArray(array $cars): array
    {
        $result = [];
        foreach ($cars as $key => $car) {
            $result[$key] = $this->fromArray($car);
        }
        return $result;
    }
}
