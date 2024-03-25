<?php

namespace App\Entity\Types\Coupons;

use Symfony\Component\Validator\Constraints as Assert;

class CouponType implements ICouponType
{
//    in case if it's not hardcoded via fabric method
//    #[Assert\NotNull]
//    #[Assert\NotBlank] and so on...
    private int $discount;
//    in case if it's not hardcoded via fabric method
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private string $code;
//    in case if it's not hardcoded via fabric method
//    #[Assert\NotNull]
//    #[Assert\NotBlank]
    private string $country;


    public function setDiscount(int $discount)
    {
        $this->discount = $discount;
    }

    public function getDiscount(): ?int
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