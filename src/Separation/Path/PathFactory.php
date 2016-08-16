<?php

namespace Separation\Path;

use PhpCollection\Sequence;
use Separation\User;

class PathFactory
{
    public function create(User $user1, User $user2, Sequence $repositories)
    {
        return new Path($user1, $user2, $repositories);
    }
}
