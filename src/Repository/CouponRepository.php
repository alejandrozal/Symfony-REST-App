<?php

namespace App\Repository;

use App\Entity\Factories\Coupons\CouponFactoryMethod;
use App\Entity\Types\Coupons\ICouponType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CouponRepository extends EntityRepository
{
    public function __construct(
        protected CouponFactoryMethod $couponFactory,
        protected ValidatorInterface $validator
    ) {}
    /**
     * @param string $couponCode
     * @return ICouponType|null
     */
    public function getCoupon(string $couponCode): ICouponType|null
    {
        //TODO refactor
        $coupon = $this->couponFactory->makeCoupon($couponCode);

        if ($coupon) {
            $validations = $this->validator->validate($coupon);
//          this is just an example of validation failure for "couponCode": "D10"
            if ($validations->count()) {
//              TODO Unit tests
                throw new ValidationFailedException($coupon, $validations);
            }
        }

        return $coupon;
    }
}