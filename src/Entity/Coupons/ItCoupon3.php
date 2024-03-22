<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class ItCoupon3 extends CouponType
{
    private string $code;
    private int $discount;

    public function __constructor() {
        $this->discount = 3;
        $this->code = 'I3';
    }
}