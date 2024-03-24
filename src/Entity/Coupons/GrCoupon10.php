<?php

namespace App\Entity\Coupons;


use App\Entity\Types\Coupons\CouponType;

class GrCoupon10 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(10);
        $this->setCode('G10');
        $this->setCountry('Greece');
    }
}