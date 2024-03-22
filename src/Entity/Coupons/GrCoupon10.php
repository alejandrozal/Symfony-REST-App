<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class GrCoupon10 extends CouponType
{
    private string $code;
    private int $discount;

    public function __constructor() {
        $this->discount = 10;
        $this->code = 'G10';
    }
}