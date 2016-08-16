<?php

namespace spec\Separation;

use PhpCollection\Sequence;
use Separation\Repository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\User;

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

    function it_should_known_which_users_have_contributed_to_it()
    {
        $user = new User('lana');
        $this->setContributors([$user]);
        $this->getContributors()->shouldContain($user);
    }
}
