<?php

namespace App\Entity\Coupons;

use App\Entity\Types\Coupons\CouponType;

class GrCoupon34 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(34);
        $this->setCode('G34');
        $this->setCountry('Greece');
    }
}