<?php

namespace spec\Separation;

use Separation\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    private $name = 'Archer';

    function let()
    {
        $this->beConstructedWith($this->name);
    }

    function it_should_have_a_username()
    {
        $this->getUsername()->shouldReturn($this->name);

    }
}
