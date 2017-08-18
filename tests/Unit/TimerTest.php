<?php

namespace Tests\Unit;

use Clarkeash\Swig\Assert;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\TransferStats;
use PHPUnit\Framework\TestCase;

class TimerTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_verify_if_it_took_less_than_x()
    {
        $response = new Response(200);
        $time = 0.2;
        $stats = new TransferStats(new Request('GET', 'http://example.com'), $response, $time);

        $this->assertTrue(Assert::response($response)->took($stats)->lessThan(300));
        $this->assertTrue(Assert::response($response)->took($stats)->lessThan(201));

        $this->assertFalse(Assert::response($response)->took($stats)->lessThan(200));
        $this->assertFalse(Assert::response($response)->took($stats)->lessThan(199));
        $this->assertFalse(Assert::response($response)->took($stats)->lessThan(0));
    }

    /**
     * @test
     */
    public function it_can_verify_if_it_took_more_than_x()
    {
        $response = new Response(200);
        $time = 0.2;
        $stats = new TransferStats(new Request('GET', 'http://example.com'), $response, $time);

        $this->assertFalse(Assert::response($response)->took($stats)->moreThan(300));
        $this->assertFalse(Assert::response($response)->took($stats)->moreThan(201));
        $this->assertFalse(Assert::response($response)->took($stats)->moreThan(200));

        $this->assertTrue(Assert::response($response)->took($stats)->moreThan(199));
        $this->assertTrue(Assert::response($response)->took($stats)->moreThan(0));
    }
}
