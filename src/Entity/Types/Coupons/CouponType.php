<?php

namespace App\Entity\Types\Coupons;

class CouponType implements ICouponType
{

    private int $discount;
    private string $code;

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
}