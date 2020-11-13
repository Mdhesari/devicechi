<?php

namespace Modules\User\Exceptions\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;

class PreviousStepRedirectHttpException extends HttpException
{
    /**
     * Route url
     *
     * @var string
     */
    protected $url;

    public function __construct(string $url, string $message = null, \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        $this->url = $url;
        parent::__construct(200, $message, $previous, $headers, $code);
    }

    public function getUrl()
    {

        return $this->url;
    }
}
