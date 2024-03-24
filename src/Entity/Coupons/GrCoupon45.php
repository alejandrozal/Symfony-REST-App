<?php

namespace App\Entity\Coupons;

use App\Entity\Types\Coupons\CouponType;

class GrCoupon45 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(45);
        $this->setCode('G45');
        $this->setCountry('Greece');
    }
}