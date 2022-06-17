<?php

namespace App\EventListener;

use App\Constans\ThrowExceptionConstans;
use App\Traits\ResponseTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

class ExceptionListener
{
    use ResponseTrait;

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $message = sprintf(
            'My Error says: %s with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );
        $response = new Response();
        $response->setContent($message);
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        }
        if ($exception instanceof ValidatorException) {
            $response = $this->error(ThrowExceptionConstans::BAD_REQUEST, $exception->getCode());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
