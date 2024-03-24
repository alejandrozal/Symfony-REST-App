<?php

namespace App\Entity\Types\Products;

use Symfony\Component\Validator\Constraints as Assert;

class ProductType implements IProductType
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private int $price;
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private int $id;
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private string $name;

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}