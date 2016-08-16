<?php

namespace spec\Separation;

use Separation\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    private $username = 'Archer';

    function let()
    {
        $this->beConstructedWith($this->username);
    }

    function it_should_have_a_username()
    {
        $this->getUsername()->shouldReturn($this->username);
    }

    function it_should_return_a_lower_case_username()
    {
        $this->getLowerCaseUsername()->shouldReturn(strtolower($this->username));
    }

}
