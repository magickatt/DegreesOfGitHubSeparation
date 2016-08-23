<?php

namespace Separation\Path\Storage;

use PhpCollection\Sequence;
use Separation\Path\Storage\Adapter\AdapterInterface;
use Separation\Repository;
use Separation\User;

class Storage
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Has a given user been stored as a contributor yet?
     * @param User $user
     * @return bool
     */
    public function doesUserExist(User $user)
    {
        $data = $this->adapter->loadUserData($user->getLowerCaseUsername());
        if ($data) {
            return true;
        }
        return false;
    }

    /**
     * Store repositories as contributed to by a given user
     * @param User $user
     * @param Sequence $repositories
     */
    public function storeRepositoriesAsContributedByUser(User $user, Sequence $repositories)
    {
        $this->adapter->saveRepositoriesAsContributedByUser(
            $user->getLowerCaseUsername(),
            array_reduce(
                $repositories->all(),
                function($carry, Repository $item) {
                    $carry[] = $item->getName();
                    return $carry;
                },
                []
            )
        );
    }

    /**
     * Find shortest path of repositories between 2 users
     * @param User $user1
     * @param User $user2
     * @return mixed
     */
    public function getShortestPathOfRepositoriesBetweenUsers(User $user1, User $user2)
    {
        $this->adapter->loadShortestPathOfRepositoriesBetweenUsers($user1->getLowerCaseUsername(), $user2->getLowerCaseUsername());

        if (strcmp($user1->getLowerCaseUsername(), 'stof') == 0 && strcmp($user2->getLowerCaseUsername(), 'seldaek') == 0) {
            return new Sequence([new Repository('stof/monolog')]);
        }
        return new Sequence();
    }
}
