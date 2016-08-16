<?php

namespace spec\Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\PathFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\Repository;
use Separation\User;

class PathFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PathFactory::class);
    }

    function it_should_create_a_path()
    {
        $this->create(
            new User('archer'),
            new User('lana'),
            new Sequence([
                new Repository('archer/burgers')
            ])
        )->shouldBeAnInstanceOf('Separation\Path\Path');
    }
}
