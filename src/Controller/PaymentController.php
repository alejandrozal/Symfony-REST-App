<?php

namespace App\Controller;

use App\Entity\Factories\PaymentSystems\PaymentSystemFactoryMethod;
use App\Entity\Types\Coupons\ICouponType;
use App\Entity\Types\Products\IProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Factories\Products\ProductFactoryMethod;
use App\Entity\Factories\Coupons\CouponFactoryMethod;
use App\Helpers\Helper;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;

class PaymentController extends AbstractController
{
    public function __construct(
        protected ProductFactoryMethod $productFactory,
        protected CouponFactoryMethod $couponFactory,
        protected PaymentSystemFactoryMethod $paymentSystemFactory,
        protected ValidatorInterface $validator
    ) {}

    public function calculatePrice(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';

        $product = $this->getProduct($productId);
        $coupon = $this->getCoupon($couponCode);

        $totalPrice = Helper::calculatePrice($taxNumber, $product, $coupon);

        return $this->json([
            'data' => ['price' => $totalPrice],
            'message' => 'Total price is ' . $totalPrice
        ]);
    }

    /**
     * @throws Exception
     */
    public function purchase(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';
        $paymentProcessor =  $data["paymentProcessor"] ?? '';

        $product = $this->getProduct($productId);
        $coupon = $this->getCoupon($couponCode);

        $totalPrice = Helper::calculatePrice($taxNumber, $product, $coupon);

        $result = $this->paymentSystemFactory->makePaymentSystem($paymentProcessor, $totalPrice);

        if (!$result) {
            $result = 'Must be the processing logic here';
        }
        return $this->json([
            'data' => $result,
            'message' => "Here's the purchase result."
        ]);
    }

    /**
     * @param int $productId
     * @return IProductType|null
     */
    public function getProduct(int $productId): IProductType|null
    {
        $product = $this->productFactory->makeProduct($productId);

        if ($product) {
            $validations = $this->validator->validate($product);
            if ($validations->count()) {
//              TODO Unit tests
//              throw new ValidationFailedException($product, $validations);
            }
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }

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
