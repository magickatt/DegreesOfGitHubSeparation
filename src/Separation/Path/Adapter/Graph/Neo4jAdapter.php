<?php

namespace Separation\Path\Adapter\Graph;

use PhpCollection\Sequence;
use Separation\User;

class Neo4jAdapter implements AdapterInterface
{
    /**
     * @inheritdoc
     */
    public function doesUserExist(User $user)
    {
        // TODO: Implement doesUserExist() method.
    }

    /**
     * @inheritdoc
     */
    public function storeRepositoriesAsContributedByUser(User $user, Sequence $repositories)
    {
        // TODO: Implement storeRepositoriesAsContributedByUser() method.
    }

    /**
     * @inheritdoc
     */
    public function getShortestPathOfRepositoriesBetweenUsers(User $user1, User $user2)
    {
        // TODO: Implement getShortestPathOfRepositoriesBetweenUsers() method.
    }

}