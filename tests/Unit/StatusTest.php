<?php

namespace Tests\Unit;

use Clarkeash\Swig\Assert;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class StatusTest
 *
 * @package \Tests\Unit
 */
class StatusTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_verify_a_status_code()
    {
        $this->assertTrue(Assert::response(new Response(200))->status()->is(200));
        $this->assertTrue(Assert::response(new Response(401))->status()->is(401));

        $this->assertFalse(Assert::response(new Response(404))->status()->is(200));
    }

    /**
     * @test
     */
    public function it_can_verify_a_status_is_within_a_range()
    {
        $this->assertTrue(Assert::response(new Response(200))->status()->inRange(200, 299));
        $this->assertTrue(Assert::response(new Response(299))->status()->inRange(200, 299));
        
        $this->assertFalse(Assert::response(new Response(199))->status()->inRange(200, 299));
        $this->assertFalse(Assert::response(new Response(300))->status()->inRange(200, 299));
    }

    /**
     * @test
     */
    public function it_can_verify_a_status_is_informational()
    {
        $this->assertTrue(Assert::response(new Response(100))->status()->isInformational());
        $this->assertTrue(Assert::response(new Response(102))->status()->isInformational());

        $this->assertFalse(Assert::response(new Response(103))->status()->isInformational());
        $this->assertFalse(Assert::response(new Response(200))->status()->isInformational());
    }

    /**
     * @test
     */
    public function it_can_verify_a_status_is_success()
    {
        $this->assertTrue(Assert::response(new Response(200))->status()->isSuccess());
        $this->assertTrue(Assert::response(new Response(208))->status()->isSuccess());
        $this->assertTrue(Assert::response(new Response(226))->status()->isSuccess());

        $this->assertFalse(Assert::response(new Response(209))->status()->isSuccess());
        $this->assertFalse(Assert::response(new Response(300))->status()->isSuccess());
    }

    /**
     * @test
     */
    public function it_can_verify_a_status_is_redirection()
    {
        $this->assertTrue(Assert::response(new Response(300))->status()->isRedirection());
        $this->assertTrue(Assert::response(new Response(305))->status()->isRedirection());
        $this->assertTrue(Assert::response(new Response(308))->status()->isRedirection());

        $this->assertFalse(Assert::response(new Response(306))->status()->isRedirection());
        $this->assertFalse(Assert::response(new Response(400))->status()->isRedirection());
    }

    /**
     * @test
     */
    public function it_can_verify_a_status_is_client_error()
    {
        $this->assertTrue(Assert::response(new Response(400))->status()->isClientError());
        $this->assertTrue(Assert::response(new Response(418))->status()->isClientError());
        $this->assertTrue(Assert::response(new Response(421))->status()->isClientError());
        $this->assertTrue(Assert::response(new Response(431))->status()->isClientError());
        $this->assertTrue(Assert::response(new Response(444))->status()->isClientError());
        $this->assertTrue(Assert::response(new Response(451))->status()->isClientError());
        $this->assertTrue(Assert::response(new Response(499))->status()->isClientError());

        $this->assertFalse(Assert::response(new Response(419))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(425))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(430))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(432))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(443))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(452))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(498))->status()->isClientError());
        $this->assertFalse(Assert::response(new Response(500))->status()->isClientError());
    }

    /**
     * @test
     */
    public function it_can_verify_a_status_is_server_error()
    {
        $this->assertTrue(Assert::response(new Response(500))->status()->isServerError());
        $this->assertTrue(Assert::response(new Response(508))->status()->isServerError());
        $this->assertTrue(Assert::response(new Response(510))->status()->isServerError());
        $this->assertTrue(Assert::response(new Response(599))->status()->isServerError());

        $this->assertFalse(Assert::response(new Response(509))->status()->isServerError());
        $this->assertFalse(Assert::response(new Response(512))->status()->isServerError());
        $this->assertFalse(Assert::response(new Response(598))->status()->isServerError());
        $this->assertFalse(Assert::response(new Response(600))->status()->isServerError());
    }
}
