<?php

namespace Separation\Path\Api\Adapter;

use Separation\Repository;
use Separation\User;

interface AdapterInterface
{
    /**
     * Load data for a repository that belongs to a given user
     * @param User $user
     * @return array
     */
    public function loadRepositoryDataForUser(User $user);

    /**
     * Load data for users that have contributed to a given repository
     * @param Repository $repository
     * @return array
     */
    public function loadContributorDataForRepository(Repository $repository);
}