<?php

namespace Separation\Path\Adapter\Graph;

use PhpCollection\Sequence;
use Separation\User;

interface AdapterInterface
{
    public function doesUserExist(User $user);

    public function storeRepositoriesAsContributedByUser(User $user, Sequence $repositories);

    public function getShortestPathOfRepositoriesBetweenUsers(User $user1, User $user2);
}