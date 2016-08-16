<?php

namespace Separation\Path\Adapter\Graph;

use PhpCollection\Sequence;
use Separation\User;

class Neo4jAdapter implements AdapterInterface
{
    public function doesUserExist(User $user)
    {
        // TODO: Implement doesUserExist() method.
    }

    public function storeRepositoriesAsContributedByUser(User $user, Sequence $repositories)
    {
        // TODO: Implement storeRepositoriesAsContributedByUser() method.
    }

    public function getShortestPathOfRepositoriesBetweenUsers(User $user1, User $user2)
    {
        // TODO: Implement getShortestPathOfRepositoriesBetweenUsers() method.
    }

}