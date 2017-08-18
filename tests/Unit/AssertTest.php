<?php

namespace Tests\Unit;

use Clarkeash\Swig\Assert;
use Clarkeash\Swig\Content;
use Clarkeash\Swig\Status;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AssertTest extends TestCase
{
    /** @test */
    public function it_supports_status()
    {
        $this->assertInstanceOf(Status::class, Assert::response(new Response(200))->status());
    }

    /** @test */
    public function it_supports_content()
    {
        $this->assertInstanceOf(Content::class, Assert::response(new Response(200))->content());
    }
}
