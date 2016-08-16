<?php

namespace spec\Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\Path;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\Repository;
use Separation\User;

class PathSpec extends ObjectBehavior
{
    private $user1;

    private $user2;

    function let()
    {
        $this->user1 = new User('archer');
        $this->user2 = new User('lana');

        $this->beConstructedWith(
            $this->user1,
            $this->user2,
            new Sequence([
                new Repository('archer/burgers')
            ])
        );
    }

    function it_should_know_the_distance_between_both_users()
    {
        $this->shortestDistance()->shouldReturn(1);
    }

    function it_should_know_which_repositories_are_in_the_path()
    {
        $this->getRepositories()->shouldBeAnInstanceOf('PhpCollection\Sequence');
    }

    function it_should_know_which_users_were_used_to_create_the_path()
    {
        $this->getUser1()->shouldBeEqualTo($this->user1);
        $this->getUser2()->shouldBeEqualTo($this->user2);
    }
}
