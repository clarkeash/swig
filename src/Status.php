<?php

namespace Clarkeash\Swig;

use GuzzleHttp\Psr7\Response;

/**
 * Class Status
 *
 * @package \Clarkeash\Swig
 */
class Status
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

    public function is(int $number)
    {
        return $this->response->getStatusCode() == $number;
    }

    public function inRange(int $from, int $to)
    {
        return $this->response->getStatusCode() >= $from && $this->response->getStatusCode() <= $to;
    }

    public function isInformational()
    {
        return $this->inRange(100, 102);
    }

    public function isSuccess()
    {
        $statuses = array_merge(range(200, 208), [226]);

        return in_array($this->response->getStatusCode(), $statuses);
    }

    public function isRedirection()
    {
        $statuses = array_merge(range(300, 305), [307, 308]);

        return in_array($this->response->getStatusCode(), $statuses);
    }

    public function isClientError()
    {
        $statuses = array_merge(range(400, 418), range(421, 424), [426, 428, 429, 431, 444, 451, 499]);

        return in_array($this->response->getStatusCode(), $statuses);
    }

    public function isServerError()
    {
        $statuses = array_merge(range(500, 508), [510, 511, 599]);

        return in_array($this->response->getStatusCode(), $statuses);
    }
}
