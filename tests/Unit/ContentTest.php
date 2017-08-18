<?php

namespace Tests\Unit;

use Clarkeash\Swig\Assert;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    /** @test */
    public function it_can_validate_json()
    {
        $response = new Response(200, [], json_encode(['name' => 'fred']));
        $this->assertTrue(Assert::response($response)->content()->isJson());

        $response = new Response(200, [], 'nope');
        $this->assertFalse(Assert::response($response)->content()->isJson());
    }

    /** @test */
    public function it_can_validate_xml()
    {
        $response = new Response(200, [], file_get_contents(__DIR__ . '/../../phpunit.xml'));
        $this->assertTrue(Assert::response($response)->content()->isXML());

        $response = new Response(200, [], 'nope');
        $this->assertFalse(Assert::response($response)->content()->isXML());
    }
}
