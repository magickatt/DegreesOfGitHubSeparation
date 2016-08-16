<?php

namespace Separation\Path\Factory;

use PhpCollection\Sequence;
use Separation\Path\Path;
use Separation\User;

class PathFactory
{
    /**
     * Create a path of repositories between 2 given users
     * @param User $user1
     * @param User $user2
     * @param Sequence $repositories
     * @return Path
     */
    public function create(User $user1, User $user2, Sequence $repositories)
    {
        return new Path($user1, $user2, $repositories);
    }
}
