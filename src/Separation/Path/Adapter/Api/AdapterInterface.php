<?php

namespace Separation\Path\Adapter\Api;

use PhpCollection\Sequence;
use Separation\Repository;
use Separation\User;

interface AdapterInterface
{
    /**
     * @param User $user
     * @return Sequence
     */
    public function getRepositoriesForUser(User $user);

    public function getContributorsForRepository(Repository $repository);
}