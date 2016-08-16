<?php

namespace spec\Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\Adapter\Api\AdapterInterface as ApiAdapterInterface;
use Separation\Path\Adapter\Graph\AdapterInterface as GraphAdapterInterface;
use Separation\Path\Path;
use Separation\Path\Factory\PathFactory;
use Separation\Path\PathResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Separation\Repository;
use Separation\User;

class PathResolverSpec extends ObjectBehavior
{
    private $apiAdapter;

    private $graphAdapter;

    private $pathFactory;

    function let(ApiAdapterInterface $apiAdapter, GraphAdapterInterface $graphAdapter, PathFactory $pathFactory)
    {
        $this->apiAdapter = $apiAdapter;
        $this->graphAdapter = $graphAdapter;
        $this->pathFactory = $pathFactory;

        $this->beConstructedWith($apiAdapter, $graphAdapter, $pathFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PathResolver::class);
    }

    function it_should_resolve_the_path_of_repositories_between_two_users()
    {
        /*
         * This is testing boundary interfaces and is therefore fragile and
         * probably should be removed in favour of more Behat scenarios
         */

        $user1 = new User('archer');
        $user2 = new User('lana');
        $repository = new Repository('archer/burgers');
        $user1Repositories = new Sequence([$repository]);
        $user2Repositories = new Sequence();
        $this->pathFactory->create($user1, $user2, $user1Repositories)->willReturn(new Path($user1, $user2, $user1Repositories));

        $this->apiAdapter->getRepositoriesForUser($user1)->willReturn($user1Repositories);
        $this->apiAdapter->getRepositoriesForUser($user2)->willReturn($user2Repositories);
        $this->apiAdapter->getContributorsForRepository($repository)->willReturn(new Sequence([$user2]));

        $this->graphAdapter->storeRepositoriesAsContributedByUser($user1, $user1Repositories)->shouldBeCalled();
        $this->graphAdapter->storeRepositoriesAsContributedByUser($user2, $user2Repositories)->shouldBeCalled();
        $this->graphAdapter->doesUserExist($user2)->willReturn(true);
        $this->graphAdapter->getShortestPathOfRepositoriesBetweenUsers($user1, $user2)->willReturn($user1Repositories);

        $this->resolvePathBetweenUsers($user1, $user2)->shouldBeAnInstanceOf('Separation\Path\Path');
    }
}
