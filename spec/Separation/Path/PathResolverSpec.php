<?php

namespace spec\Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\Adapter\AdapterInterface;
use Separation\Path\Path;
use Separation\Path\PathFactory;
use Separation\Path\PathResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\Repository;
use Separation\User;

class PathResolverSpec extends ObjectBehavior
{
    private $pathFactory;

    function let(AdapterInterface $adapter, PathFactory $pathFactory)
    {
        $this->pathFactory = $pathFactory;

        $this->beConstructedWith($adapter, $pathFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PathResolver::class);
    }

    function it_should_resolve_the_path_of_repositories_between_two_users()
    {
        $user1 = new User('archer');
        $user2 = new User('lana');
        $repositories = new Sequence([new Repository('archer/burgers')]);
        $this->pathFactory->create($user1, $user2, $repositories)->willReturn(new Path($user1, $user2, $repositories));

        $this->resolvePathBetweenUsers($user1, $user2)->shouldBeAnInstanceOf('Separation\Path\Path');
    }
}
