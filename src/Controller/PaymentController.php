<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends AbstractController
{
    public function calculatePrice(Request $request): JsonResponse
    {
        return $this->json([
            'data' => $request->get("test"),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaymentController.php',
        ]);
    }

    public function purchase(Request $request): JsonResponse
    {
        return $this->json([
            'data' => $request->get("test"),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaymentController.php',
        ]);
    }
}
