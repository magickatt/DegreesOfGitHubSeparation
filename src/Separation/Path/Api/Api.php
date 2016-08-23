<?php

namespace Separation\Path\Api;

use PhpCollection\Sequence;
use Separation\Path\Api\Adapter\AdapterInterface;
use Separation\Path\Factory\RepositoryFactory;
use Separation\Path\Factory\UserFactory;
use Separation\Repository;
use Separation\User;

class Api
{
    /** @var UserFactory */
    private $userFactory;

    /** @var RepositoryFactory */
    private $repositoryFactory;

    /** @var AdapterInterface */
    private $adapter;

    /**
     * @inheritdoc
     */
    public function __construct(UserFactory $userFactory, RepositoryFactory $repositoryFactory, AdapterInterface $adapter)
    {
        $this->userFactory = $userFactory;
        $this->repositoryFactory = $repositoryFactory;
        $this->adapter = $adapter;
    }

    /**
     * Get repositories that belong to a given user
     * @param User $user
     * @return Sequence
     */
    public function getRepositoriesForUser(User $user)
    {
        $repositories = new Sequence();
        $data = $this->adapter->loadRepositoryDataForUser($user);
        if (!empty($data)) {

            foreach ($data as $item) {
                $repository = $this->repositoryFactory->createFromData($item);
                if ($repository instanceof Repository) {
                    $repositories->add($repository);
                }
            }

        }
        return $repositories;
    }

    /**
     * Get users that have contributed to a given repository
     * @param Repository $repository
     * @return Sequence
     */
    public function getContributorsForRepository(Repository $repository)
    {
        $users = new Sequence();
        $data = $this->adapter->loadContributorDataForRepository($repository);
        if (!empty($data)) {

            foreach ($data as $item) {
                $user = $this->userFactory->createFromData($item);
                if ($user instanceof User) {
                    $users->add($user);
                }
            }

        }
        return $users;
    }
}
