<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class GrCoupon34 extends CouponType
{
    private string $code;
    private int $discount;

    public function __constructor() {
        $this->discount = 34;
        $this->code = 'G34';
    }
}