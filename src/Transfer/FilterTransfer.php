<?php

namespace App\Transfer;

use Symfony\Component\Validator\Constraints as Assert;

class FilterTransfer extends BaseTransfer
{
    #[Assert\Type('string')]
    private ?string $color = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private ?string $brand = self::STRING_DEFAULT;

    #[Assert\Type('int')]
    #[Assert\Choice(
        choices: self::SEATS_LIST,
    )]
    private ?int $seats = self::INT_DEFAULT;

    #[Assert\Type('int')]
    private ?int $limit = self::LIMIT_DEFAULT;

    #[Assert\Choice(
        choices: self::ORDER_BY_LIST,
    )]
    private ?string $orderBy = self::ORDER_BY_DEFAULT;

    #[Assert\Choice(
        choices: self::ORDER_TYPE_LIST,
    )]
    private ?string $orderType = self::ORDER_TYPE_DEFAULT;

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     */
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int|null
     */
    public function getSeats(): ?int
    {
        return $this->seats;
    }

    /**
     * @param int|null $seats
     */
    public function setSeats(?int $seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @param string|null $orderBy
     */
    public function setOrderBy(?string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return string|null
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return string|null
     */
    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    /**
     * @param string|null $orderType
     */
    public function setOrderType(?string $orderType): void
    {
        $this->orderType = $orderType;
    }
}
