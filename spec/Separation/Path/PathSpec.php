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
    function let()
    {
        $this->beConstructedWith(
            new User('archer'),
            new User('lana'),
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
}
