<?php

namespace spec\Separation\Path\Factory;

use PhpCollection\Sequence;
use Separation\Path\Factory\PathFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\Repository;
use Separation\User;

class PathFactorySpec extends ObjectBehavior
{
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
