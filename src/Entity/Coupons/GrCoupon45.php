<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class GrCoupon45 extends CouponType
{
    private string $code;
    private int $discount;

    public function __constructor() {
        $this->discount = 45;
        $this->code = 'G45';
    }
}