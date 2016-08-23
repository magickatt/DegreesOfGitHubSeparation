<?php

namespace Separation\Path\Storage\Adapter;

use PhpCollection\Sequence;
use Separation\User;

class Neo4jAdapter implements AdapterInterface
{
    public function loadUserData($username)
    {
        // TODO: Implement loadUserData() method.
    }

    public function saveRepositoriesAsContributedByUser($username, array $repositories)
    {
        // TODO: Implement saveRepositoriesAsContributedByUser() method.
    }

    public function loadShortestPathOfRepositoriesBetweenUsers($username1, $username2)
    {
        // TODO: Implement loadShortestPathOfRepositoriesBetweenUsers() method.
    }
}