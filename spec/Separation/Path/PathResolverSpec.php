<?php

namespace spec\Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\Api\Api;
use Separation\Path\Path;
use Separation\Path\Factory\PathFactory;
use Separation\Path\PathResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\Path\Storage\Storage;
use Separation\Repository;
use Separation\User;

class PathResolverSpec extends ObjectBehavior
{
    private $api;

    private $graph;

    private $pathFactory;

    function let(Api $api, Storage $storage, PathFactory $pathFactory)
    {
        $this->api = $api;
        $this->graph = $storage;
        $this->pathFactory = $pathFactory;

        $this->beConstructedWith($api, $storage, $pathFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PathResolver::class);
    }

    function it_should_resolve_the_path_of_repositories_between_two_users()
    {
        $user1 = new User('archer');
        $user2 = new User('lana');
        $repository = new Repository('archer/burgers');
        $user1Repositories = new Sequence([$repository]);
        $user2Repositories = new Sequence();

        $this->pathFactory->create($user1, $user2, $user1Repositories)->willReturn(new Path($user1, $user2, $user1Repositories));

        $this->api->getRepositoriesForUser($user1)->willReturn($user1Repositories);
        $this->api->getRepositoriesForUser($user2)->willReturn($user2Repositories);
        $this->api->getContributorsForRepository($repository)->willReturn(new Sequence([$user2]));

        $this->graph->storeRepositoriesAsContributedByUser($user1, $user1Repositories)->shouldBeCalled();
        $this->graph->doesUserExist($user2)->willReturn(true);
        $this->graph->getShortestPathOfRepositoriesBetweenUsers($user1, $user2)->willReturn($user1Repositories);

        $this->resolvePathBetweenUsers($user1, $user2)->shouldBeAnInstanceOf('Separation\Path\Path');
    }
}
