<?php

namespace App\Controller;

use App\Entity\Factories\PaymentSystems\PaymentSystemFactoryMethod;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Helpers\Helper;
use Exception;

class PaymentController extends AbstractController
{
    public function __construct(
        protected CouponRepository $couponRepository,
        protected ProductRepository $productRepository,
        protected PaymentSystemFactoryMethod $paymentSystemFactory,
    ) {}

    public function calculatePrice(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';

        $product = $this->productRepository->getProduct($productId);
        $coupon = $this->couponRepository->getCoupon($couponCode);

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

        $product = $this->productRepository->getProduct($productId);
        $coupon = $this->couponRepository->getCoupon($couponCode);

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
}
