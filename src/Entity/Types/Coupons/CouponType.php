<?php

namespace App\Entity\Types\Coupons;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class CouponType implements ICouponType
{

    private int $discount;
    private string $code;
    private string $country;

    /**
     * @Assert\NotBlank
     */
    public function setDiscount(int $discount)
    {
        $this->discount = $discount;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}