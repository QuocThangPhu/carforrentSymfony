<?php

namespace App\Transfer;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateWithMethodPatchCarTransfer extends BaseTransfer
{
    #[Assert\Type('string')]
    private ?string $name = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private ?string $description = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private ?string $color = self::STRING_DEFAULT;

    #[Assert\Type('string')]
    private ?string $brand = self::STRING_DEFAULT;

    #[Assert\Type('integer')]
    #[Assert\Choice(
        choices: self::SEATS_LIST,
    )]
    private ?int $seats = null;

    #[Assert\Type('integer')]
    private ?int $year = null;

    #[Assert\Type('float')]
    private ?float $price = null;

    private $createdUserId;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

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
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     */
    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
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

    private \DateTimeImmutable $createdAt;

    private $thumbnail;
}
