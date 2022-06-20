<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $path;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\OneToOne(mappedBy: 'thumbnailId', targetEntity: Car::class, cascade: ['persist', 'remove'])]
    private $car;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(Car $car): self
    {
        // set the owning side of the relation if necessary
        if ($car->getThumbnailId() !== $this) {
            $car->setThumbnailId($this);
        }

        $this->car = $car;

        return $this;
    }

    #[ArrayShape(['id' => "int|null", 'path' => "null|string"])]
    public function jsonParse(): array
    {
        return [
            'id' => $this->getId(),
            'path' => $this->getPath()
        ];
    }
}
