<?php

namespace Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\Adapter\Api\AdapterInterface as ApiAdapterInterface;
use Separation\Path\Adapter\Graph\AdapterInterface as GraphAdapterInterface;
use Separation\Repository;
use Separation\User;

class PathResolver
{
    private $apiAdapter;

    private $graphAdapter;

    private $pathFactory;

    public function __construct(ApiAdapterInterface $apiAdapter, GraphAdapterInterface $graphAdapter, PathFactory $pathFactory)
    {
        $this->apiAdapter = $apiAdapter;
        $this->graphAdapter = $graphAdapter;
        $this->pathFactory = $pathFactory;
    }

    public function resolvePathBetweenUsers(User $user1, User $user2)
    {
        return $this->pathFactory->create($user1, $user2, new Sequence([new Repository('archer/burgers')]));
    }
}
