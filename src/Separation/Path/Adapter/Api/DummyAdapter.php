<?php

namespace Separation\Path\Adapter\Api;

use PhpCollection\Sequence;
use Separation\Path\Factory\RepositoryFactory;
use Separation\Path\Factory\UserFactory;
use Separation\Repository;
use Separation\User;

class DummyAdapter implements AdapterInterface
{
    /** @var UserFactory */
    private $userFactory;

    /** @var RepositoryFactory */
    private $repositoryFactory;

    /**
     * @inheritdoc
     */
    public function __construct(UserFactory $userFactory, RepositoryFactory $repositoryFactory)
    {
        $this->userFactory = $userFactory;
        $this->repositoryFactory = $repositoryFactory;
    }

    /**
     * @inheritdoc
     */
    public function getRepositoriesForUser(User $user)
    {
        $repositories = new Sequence();
        $data = $this->loadRepositoryDataFromFilesystem($user);
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
        $data = $this->loadContributorDataFromFilesystem($repository);
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

    /**
     * Dummy JSON decoding
     * @param Repository $repository
     * @return array|null
     */
    private function loadContributorDataFromFilesystem(Repository $repository)
    {
        $repositoryNameParts = explode('/', $repository->getName());
        $userLogin = strtolower($repositoryNameParts[0]);
        $repositoryName = $repositoryNameParts[1];

        $filename = $this->resolveDataDirectory().'data'.DIRECTORY_SEPARATOR.'dummy'.DIRECTORY_SEPARATOR.
            $userLogin.DIRECTORY_SEPARATOR.'contributors'.DIRECTORY_SEPARATOR.$repositoryName.'.json';

        if (!file_exists($filename)) {
            return;
        }

        $json = file_get_contents($filename);
        return json_decode($json, true);
    }

    /**
     * Dummy JSON decoding
     * @param User $user
     * @return array|null
     */
    private function loadRepositoryDataFromFilesystem(User $user)
    {
        $filename = $this->resolveDataDirectory().'data'.DIRECTORY_SEPARATOR.'dummy'.DIRECTORY_SEPARATOR.
            $user->getLowerCaseUsername().DIRECTORY_SEPARATOR.'repos.json';

        if (!file_exists($filename)) {
            return;
        }

        $json = file_get_contents($filename);
        return json_decode($json, true);
    }

    /**
     * Convenience method
     * @return string
     */
    private function resolveDataDirectory()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
    }

}