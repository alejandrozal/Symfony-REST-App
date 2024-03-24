<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

class PaymentController extends AbstractController
{
    public function calculatePrice(Request $request): JsonResponse
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $user = new De('John Doe', 'john@example.com');

        $violations = $validator->validate($user);
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
