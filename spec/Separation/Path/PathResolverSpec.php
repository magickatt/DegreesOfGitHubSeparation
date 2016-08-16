<?php

namespace spec\Separation\Path;

use Separation\Path\Adapter\AdapterInterface;
use Separation\Path\PathFactory;
use Separation\Path\PathResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PathResolverSpec extends ObjectBehavior
{
    function let(AdapterInterface $adapter, PathFactory $pathFactory)
    {
        $this->beConstructedWith($adapter, $pathFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PathResolver::class);
    }
}
