<?php

namespace Separation\Path\Adapter\Api;

use Separation\Repository;
use Separation\User;

class DummyAdapter implements AdapterInterface
{
    public function getRepositoriesForUser(User $user)
    {
        switch ($user->getUsername()) {
            case 'seldaek':
                return '';
            case 'stof':
                return '';
        }
    }

    public function getContributorsForRepository(Repository $repository)
    {

    }

}