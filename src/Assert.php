<?php

namespace Clarkeash\Swig;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\TransferStats;

class Assert
{
    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    protected $response;

    /**
     * Assert constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Named constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     *
     * @return static
     */
    public static function response(Response $response)
    {
        return new static($response);
    }

    public function status()
    {
        return new Status($this->response);
    }

    public function content()
    {
        return new Content($this->response);
    }

    public function took(TransferStats $stats)
    {
        return new Timer($stats);
    }
}
