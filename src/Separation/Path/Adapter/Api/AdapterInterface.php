<?php

namespace Separation\Path\Adapter\Api;

use PhpCollection\Sequence;
use Separation\Repository;
use Separation\User;

interface AdapterInterface
{
    /**
     * Get repositories that belong to a given user
     * @param User $user
     * @return Sequence
     */
    public function getRepositoriesForUser(User $user);

    /**
     * Get users that have contributed to a given repository
     * @param Repository $repository
     * @return Sequence
     */
    public function getContributorsForRepository(Repository $repository);
}