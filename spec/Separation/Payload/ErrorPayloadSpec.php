<?php

namespace spec\Separation\Payload;

use Separation\Path\Exception\PathException;
use Separation\Payload\ErrorPayload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ErrorPayloadSpec extends ObjectBehavior
{
    private $exception;

    function let()
    {
        $this->exception = new PathException('Test');
        $this->beConstructedWith($this->exception);
    }

    function it_should_contain_the_exception_error_message()
    {
        $this->generatePayload()->shouldHaveKeyWithValue('error', $this->exception->getMessage());
    }
}
