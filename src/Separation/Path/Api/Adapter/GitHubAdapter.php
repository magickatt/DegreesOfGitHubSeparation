<?php

namespace Separation\Path\Api\Adapter;

use Github\Client as GithubClient;
use Separation\Repository;
use Separation\User;

class GitHubAdapter implements AdapterInterface
{
    /** @var GithubClient */
    private $githubClient;

    /**
     * @inheritdoc
     */
    public function __construct(GithubClient $githubClient)
    {
        $this->githubClient = $githubClient;
    }

    public function loadRepositoryDataForUser(User $user)
    {
        // TODO: Implement loadRepositoryDataForUser() method.
    }

    public function loadContributorDataForRepository(Repository $repository)
    {
        // TODO: Implement loadContributorDataForRepository() method.
    }
}