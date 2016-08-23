<?php

namespace Separation\Path\Storage\Adapter;

interface AdapterInterface
{
    /**
     * Load user data for a given username
     * @param string $username
     * @return array
     */
    public function loadUserData($username);

    /**
     * Save repositories as contributed to by a given user
     * @param string $username
     * @param array $repositories
     */
    public function saveRepositoriesAsContributedByUser($username, array $repositories);

    /**
     * Find shortest path of repositories between 2 users
     * @param string $username1
     * @param string $username2
     * @return array
     */
    public function loadShortestPathOfRepositoriesBetweenUsers($username1, $username2);
}