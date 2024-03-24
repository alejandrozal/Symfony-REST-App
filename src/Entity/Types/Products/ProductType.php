<?php

namespace App\Entity\Types\Products;

use Symfony\Component\Validator\Constraints as Assert;

class ProductType implements IProductType
{

    private int $price;
    private int $id;
    private string $name;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    #[Assert\NotNull]
    #[Assert\NotBlank]
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    #[Assert\NotNull]
    #[Assert\NotBlank]
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}