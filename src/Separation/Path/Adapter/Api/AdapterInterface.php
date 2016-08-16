<?php

namespace Separation\Path\Adapter\Api;

use Separation\Repository;
use Separation\User;

interface AdapterInterface
{
    public function getRepositoriesForUser(User $user);

    public function getContributorsForRepository(Repository $repository);
}