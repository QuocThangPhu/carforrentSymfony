<?php

namespace App\Validator;

use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RentValidator
{
    use TransferTrait;
    use ResponseTrait;

    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validatorRentRequest(mixed $param): array
    {
        $errors = $this->validator->validate($param);
        if (!empty($errors)) {
            return $this->errorToArray($errors);
        }

        return [];
    }
}
