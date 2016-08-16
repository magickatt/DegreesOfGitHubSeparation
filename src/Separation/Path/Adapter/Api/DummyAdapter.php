<?php

namespace Separation\Path\Adapter\Api;

use PhpCollection\Sequence;
use Separation\Path\Factory\RepositoryFactory;
use Separation\Path\Factory\UserFactory;
use Separation\Repository;
use Separation\User;

class DummyAdapter implements AdapterInterface
{
    private $userFactory;

    private $repositoryFactory;

    public function __construct(UserFactory $userFactory, RepositoryFactory $repositoryFactory)
    {
        $this->userFactory = $userFactory;
        $this->repositoryFactory = $repositoryFactory;
    }

    /**
     * @param User $user
     * @return Sequence
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

    private function resolveDataDirectory()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
    }

}