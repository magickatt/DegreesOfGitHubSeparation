<?php

namespace Separation\Path\Storage\Adapter;

class DummyAdapter implements AdapterInterface
{
    public function loadUserData($username)
    {
        if ($username == 'seldaek') {
            return true;
        }
    }

    public function saveRepositoriesAsContributedByUser($username, array $repositories)
    {
        // TODO: Implement saveRepositoriesAsContributedByUser() method.
    }

    public function loadShortestPathOfRepositoriesBetweenUsers($username1, $username2)
    {
        if (strcmp($username1, 'stof') == 0 && strcmp($username2, 'seldaek') == 0) {
            return ['stof/monolog'];
        }
    }
}