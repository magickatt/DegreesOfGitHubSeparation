<?php

namespace Separation\Path\Api\Adapter;

use PhpCollection\Sequence;
use Separation\Path\Factory\RepositoryFactory;
use Separation\Path\Factory\UserFactory;
use Separation\Repository;
use Separation\User;

class DummyAdapter implements AdapterInterface
{
    /**
     * @inheritdoc
     */
    public function loadRepositoryDataForUser(User $user)
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
     * Get users that have contributed to a given repository
     * @param Repository $repository
     * @return Sequence
     */
    public function loadContributorDataForRepository(Repository $repository)
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
     * Convenience method
     * @return string
     */
    private function resolveDataDirectory()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
    }
}