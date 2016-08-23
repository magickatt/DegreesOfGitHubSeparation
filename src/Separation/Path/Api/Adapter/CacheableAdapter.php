<?php

namespace Separation\Path\Api\Adapter;

use Separation\Repository;
use Separation\User;

class CacheableAdapter implements AdapterInterface
{
    /** @var GitHubAdapter */
    private $githubAdapter;

    public function __construct(GitHubAdapter $gitHubAdapter)
    {
        $this->githubAdapter = $gitHubAdapter;
    }

    public function loadRepositoryDataForUser(User $user)
    {
        $data = $this->githubAdapter->loadRepositoryDataForUser($user);

        $filename = $this->resolveDataDirectory().$user->getLowerCaseUsername().DIRECTORY_SEPARATOR.'repos.json';
        file_put_contents($filename, serialize($data));

        return $data;
    }

    public function loadContributorDataForRepository(Repository $repository)
    {
        $data = $this->githubAdapter->loadContributorDataForRepository($repository);


    }

    /**
     * Convenience method
     * @return string
     */
    private function resolveDataDirectory()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.
        DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR;
    }
}