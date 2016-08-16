<?php

namespace Separation\Path;

use PhpCollection\Sequence;
use Separation\Path\Adapter\AdapterInterface;
use Separation\Repository;
use Separation\User;

class PathResolver
{
    private $adapter;

    private $pathFactory;

    public function __construct(AdapterInterface $adapter, PathFactory $pathFactory)
    {
        $this->adapter = $adapter;
        $this->pathFactory = $pathFactory;
    }

    public function resolvePathBetweenUsers(User $user1, User $user2)
    {
        return $this->pathFactory->create($user1, $user2, new Sequence([new Repository('archer/burgers')]));
    }
}
