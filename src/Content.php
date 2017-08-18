<?php

namespace Clarkeash\Swig;

use GuzzleHttp\Psr7\Response;
use XMLReader;

class Content
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

    public function isJson()
    {
        try
        {
            \GuzzleHttp\json_decode($this->response->getBody()->getContents());

            return true;
        }
        catch (\InvalidArgumentException $exception)
        {
            return false;
        }
    }

    public function isXML()
    {
        $contents = $this->response->getBody()->getContents();

        if (trim($contents) == '') return false;

        libxml_use_internal_errors(true);

        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML($contents);

        $errors = libxml_get_errors();
        libxml_clear_errors();

        return empty($errors);
    }
}
