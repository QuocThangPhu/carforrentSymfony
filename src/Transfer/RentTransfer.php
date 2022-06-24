<?php

namespace App\Transfer;
use Symfony\Component\Validator\Constraints as Assert;

class RentTransfer extends BaseTransfer
{
    /**
     * @var
     */
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private $carId;

    /**
     * @var "Y-m-d H:i:s" formatted value
     */
    #[Assert\NotBlank]
    #[Assert\Type('DateTime')]
    private $startDate;

    #[Assert\NotBlank]
    #[Assert\Type('DateTime')]
    private $endDate;

    /**
     * @return mixed
     */
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * @param mixed $carId
     */
    public function setCarId($carId): void
    {
        $this->carId = $carId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

}
