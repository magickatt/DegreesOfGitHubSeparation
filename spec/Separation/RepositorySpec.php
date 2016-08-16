<?php

namespace spec\Separation;

use Separation\Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositorySpec extends ObjectBehavior
{
    private $name = 'archer/burgers';

    function let()
    {
        $this->beConstructedWith($this->name);
    }

    function it_should_have_a_name()
    {
        $this->getName()->shouldReturn($this->name);
    }
}
