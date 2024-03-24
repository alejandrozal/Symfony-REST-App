<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class FrCoupon5 extends CouponType
{
    private string $code;
    private string $country;
    private int $discount;

    public function __constructor() {
        $this->discount = 5;
        $this->code = 'F5';
        $this->country = 'France';
    }
}