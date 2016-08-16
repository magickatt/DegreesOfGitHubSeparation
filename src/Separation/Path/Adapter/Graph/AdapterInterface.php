<?php

namespace Separation\Path\Adapter\Graph;

use PhpCollection\Sequence;
use Separation\User;

interface AdapterInterface
{
    /**
     * Has a given user been stored as a contributor yet?
     * @param User $user
     * @return bool
     */
    public function doesUserExist(User $user);

    /**
     * Store repositories as contributed to by a given user
     * @param User $user
     * @param Sequence $repositories
     * @return mixed
     */
    public function storeRepositoriesAsContributedByUser(User $user, Sequence $repositories);

    /**
     * Find shortest path of repositories between 2 users
     * @param User $user1
     * @param User $user2
     * @return mixed
     */
    public function getShortestPathOfRepositoriesBetweenUsers(User $user1, User $user2);
}