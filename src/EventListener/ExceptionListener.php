<?php

namespace App\EventListener;

use App\Helpers\ValidationFailedErrorsBuilder;
use App\Http\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Throwable;

class ExceptionListener
{
    public function __construct(
        private ValidationFailedErrorsBuilder $validationFailedErrorsBuilder
    ) { }

    public function __invoke(ExceptionEvent $event): void
    {

        // You get the exception object from the received event
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        if (
            in_array('application/json', $request->getAcceptableContentTypes())
            || $exception instanceof NotFoundHttpException
            || $exception instanceof MethodNotAllowedHttpException
            || $exception instanceof ValidationFailedException
            || $exception instanceof BadRequestHttpException
        ) {
            $response = $this->createApiResponse($exception);
            $event->setResponse($response);
        }
    }

    /**
     * Creates the ApiResponse from any Exception
     *
     * @param Throwable $exception
     *
     * @return ApiResponse
     */
    private function createApiResponse(Throwable $exception): ApiResponse
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
        $errors = $this->validationFailedErrorsBuilder->build($exception->getViolations());;

        return new ApiResponse($exception->getMessage(), null, $errors, $statusCode);
    }
}