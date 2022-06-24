<?php

namespace App\Transformer;

use App\Entity\Rent;

class RentTransformer extends BaseTransformer
{
    const PARAMS = ['id' ,'status' ,'startDate' ,'endDate', 'user', 'car'];
    public function fromArray(Rent $rent): array
    {
        $result = $this->transform($rent, static::PARAMS);
        $result['user'] = $rent->getUser()->jsonParse();
        $result['car'] = $rent->getCar()->jsonParse();

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