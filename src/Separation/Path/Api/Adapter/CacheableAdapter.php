<?php

namespace Separation\Path\Api\Adapter;

use Separation\Repository;
use Separation\User;

class CacheableAdapter implements AdapterInterface
{
    /** @var AdapterInterface */
    private $originalAdapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->originalAdapter = $adapter;
    }

    public function loadRepositoryDataForUser(User $user)
    {
        $data = $this->loadRepositoryDataFromCache($user);
        if ($data) {
            return $data;
        }

        $data = $this->originalAdapter->loadRepositoryDataForUser($user);
        $this->saveRepositoryDataToCache($user, $data);
        return $data;
    }

    public function loadContributorDataForRepository(Repository $repository)
    {
        $data = $this->loadContributorDataForRepositoryFromCache($repository);
        if ($data) {
            return $data;
        }

        $data = $this->originalAdapter->loadContributorDataForRepository($repository);
        $this->saveContributorDataForRepositoryToCache($repository, $data);
        return $data;
    }

    private function loadRepositoryDataFromCache(User $user)
    {
        $filename = $this->resolveRepositoriesFilename($user);
        return $this->loadFromCache($filename);
    }

    private function saveRepositoryDataToCache(User $user, $data)
    {
        $filename = $this->resolveRepositoriesFilename($user);
        $this->saveToCache($filename, $data);
    }

    private function resolveRepositoriesFilename(User $user)
    {
        return $this->resolveDataDirectory().$user->getLowerCaseUsername().DIRECTORY_SEPARATOR.'repos.json';
    }

    private function loadContributorDataForRepositoryFromCache(Repository $repository)
    {
        $filename = $this->resolveContributorsFilename($repository);
        return $this->loadFromCache($filename);
    }

    private function saveContributorDataForRepositoryToCache(Repository $repository, $data)
    {
        $filename = $this->resolveContributorsFilename($repository);
        $this->saveToCache($filename, $data);
    }

    private function resolveContributorsFilename(Repository $repository)
    {
        $repositoryNameParts = explode('/', $repository->getName());
        $userLogin = strtolower($repositoryNameParts[0]);
        $repositoryName = $repositoryNameParts[1];

        return $this->resolveDataDirectory().$userLogin.DIRECTORY_SEPARATOR.'contributors'.
            DIRECTORY_SEPARATOR.$repositoryName.'.json';
    }

    private function loadFromCache($filename)
    {
        if (file_exists($filename) && is_file($filename)) {
            $data = file_get_contents($filename);
            return unserialize($data);
        }
    }

    private function saveToCache($filename, $data)
    {
        $umask = umask(0);

        $path = dirname($filename);
        if (!is_dir($path)) {
            mkdir($path, 0777, true); // @todo Restrict permissions
        }
        file_put_contents($filename, serialize($data));

        umask($umask);
    }

    /**
     * Convenience method
     * @return string
     */
    private function resolveDataDirectory()
    {
        return '/tmp/cachedir/';

        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.
        DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR;
    }
}