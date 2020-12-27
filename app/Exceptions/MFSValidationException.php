<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class MFSValidationException extends HttpException
{
    /**
     * Route url
     *
     * @var string
     */
    protected $errors;

    public function __construct(array $errors, string $message = null, \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        $this->errors = $errors;
        parent::__construct(200, $message, $previous, $headers, $code);
    }

    public function getErrors()
    {

        return $this->errors;
    }
}
