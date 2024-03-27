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
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;

class PaymentController extends AbstractController
{
    private ProductFactoryMethod $productFactory;
    private CouponFactoryMethod $couponFactory;
    private PaymentSystemFactoryMethod $paymentSystemFactory;

    public function __construct()
    {
        $this->productFactory = new ProductFactoryMethod();
        $this->couponFactory = new CouponFactoryMethod();
        $this->paymentSystemFactory = new PaymentSystemFactoryMethod();
    }

    public function calculatePrice(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';

        $product = $this->getProduct($productId, $validator);
        $coupon = $this->getCoupon($couponCode, $validator);

        $totalPrice = Helper::calculatePrice($taxNumber, $product, $coupon);

        return $this->json([
            'data' => ['price' => $totalPrice],
            'message' => 'Total price is ' . $totalPrice
        ]);
    }

    /**
     * @throws Exception
     */
    public function purchase(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';
        $paymentProcessor =  $data["paymentProcessor"] ?? '';

        $product = $this->getProduct($productId, $validator);
        $coupon = $this->getCoupon($couponCode, $validator);

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
     * @param ValidatorInterface $validator
     * @return IProductType|null
     */
    public function getProduct(int $productId, ValidatorInterface $validator): IProductType|null
    {
        $product = $this->productFactory->makeProduct($productId);

        if ($product) {
            $validations = $validator->validate($product);
            if ($validations->count()) {
//              TODO Unit tests
//              throw new ValidatorException($validations);
            }
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }

    /**
     * @param string $couponCode
     * @param ValidatorInterface $validator
     * @return ICouponType|null
     */
    public function getCoupon(string $couponCode, ValidatorInterface $validator): ICouponType|null
    {
        //TODO refactor
        $coupon = $this->couponFactory->makeCoupon($couponCode);

        if ($coupon) {
            $validations = $validator->validate($coupon);
//          this is just an example of validation failure for "couponCode": "D10"
            if ($validations->count()) {
//              TODO Unit tests
                throw new ValidatorException($validations);
            }
        }

        return $coupon;
    }
}
