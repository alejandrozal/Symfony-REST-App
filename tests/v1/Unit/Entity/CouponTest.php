<?php

namespace App\Tests\v1\Unit\Entity;

use App\Entity\Coupons\DeCoupon15;
use PHPUnit\Framework\TestCase;

class CouponTest extends TestCase
{
    public function testCanGetAndSetData(): void
    {
        $coupon = new DeCoupon15();
        $coupon->setDiscount(15);
        $coupon->setCode('D15');
        $coupon->setCountry('Germany');

        self::assertSame(15, $coupon->getDiscount());
        self::assertSame('D15', $coupon->getCode());
        self::assertSame('Germany', $coupon->getCountry());
    }
}
