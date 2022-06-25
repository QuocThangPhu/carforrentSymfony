<?php

namespace App\Transfer;

use Symfony\Component\Validator\Constraints as Assert;

class FilterTransfer extends BaseTransfer
{
    #[Assert\Type('string')]
    private $color = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private $brand = self::STRING_DEFAULT;

    #[Assert\Type('integer')]
    #[Assert\Choice(
        choices: self::SEATS_LIST,
    )]
    private $seats = self::INT_DEFAULT;

    #[Assert\Type('int')]
    private $limit = self::LIMIT_DEFAULT;

    #[Assert\Choice(
        choices: self::ORDER_BY_LIST,
    )]
    private $orderBy = self::ORDER_BY_DEFAULT;

    #[Assert\Choice(
        choices: self::ORDER_TYPE_LIST,
    )]
    private $orderType = self::ORDER_TYPE_DEFAULT;

    /**
     * @return null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param null $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param null $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = is_numeric($seats) ? (int)$seats : $seats;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     */
    public function setOrderType(string $orderType): void
    {
        $this->orderType = $orderType;
    }
}
