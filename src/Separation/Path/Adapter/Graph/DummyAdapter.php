<?php

namespace Separation\Path\Adapter\Graph;

use PhpCollection\Sequence;
use Separation\Repository;
use Separation\User;

class DummyAdapter implements AdapterInterface
{
    public function doesUserExist(User $user)
    {
        if ($user->getLowerCaseUsername() == 'seldaek') {
            return true;
        }
    }

    public function storeRepositoriesAsContributedByUser(User $user, Sequence $repositories)
    {
        // TODO: Implement storeRepositoriesAsContributedByUser() method.
    }

    public function getShortestPathOfRepositoriesBetweenUsers(User $user1, User $user2)
    {
        if (strcmp($user1->getLowerCaseUsername(), 'stof') == 0 && strcmp($user2->getLowerCaseUsername(), 'seldaek') == 0) {
            return new Sequence([new Repository('stof/monolog')]);
        }
        return new Sequence();
    }
}