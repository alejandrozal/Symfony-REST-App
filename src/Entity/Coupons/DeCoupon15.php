<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class DeCoupon15 extends CouponType
{
    private string $code;
    private int $discount;

    public function __constructor() {
        $this->discount = 15;
        $this->code = 'D15';
    }
}