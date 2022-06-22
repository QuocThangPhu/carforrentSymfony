<?php

namespace App\Transfer;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateWithMethodPatchCarTransfer extends BaseTransfer
{
    #[Assert\Type('string')]
    private $name = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private $description = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private $color = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private $brand = self::STRING_DEFAULT;

    #[Assert\Type('integer')]
    #[Assert\Choice(
        choices: self::SEATS_LIST,
    )]
    private $seats = null;

    #[Assert\Type('integer')]
    private $year = null;

    #[Assert\Type('numeric')]
    private $price = null;

    private $createdUserId;

    private \DateTimeImmutable $createdAt;

    private $thumbnail;

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

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
     * @return null
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param null $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param null $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }

    /**
     * @param mixed $createdUserId
     */
    public function setCreatedUserId($createdUserId): void
    {
        $this->createdUserId = $createdUserId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }
}
