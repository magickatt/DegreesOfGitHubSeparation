<?php

namespace Separation\Path\Api\Adapter;

use Github\Api\ApiInterface;
use Github\Client as GithubClient;
use Github\ResultPager;
use Github\ResultPagerInterface;
use Separation\Path\Exception\ThirdPartyException;
use Separation\Repository;
use Separation\User;

class GitHubAdapter implements AdapterInterface
{
    /** @var GithubClient */
    private $githubClient;

    /** @var int */
    private $callCount = 0;

    /**
     * @inheritdoc
     */
    public function __construct(GithubClient $githubClient)
    {
        $this->githubClient = $githubClient;
    }

    public function loadRepositoryDataForUser(User $user)
    {
        $paginator  = new ResultPager($this->githubClient); // @todo Factory here
        $api = $this->githubClient->api('user');

        try {
            return $this->fetchAllRepositoryDataForUser($api, $paginator, $user);
        } catch (\Exception $exception) {
            throw new ThirdPartyException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function loadContributorDataForRepository(Repository $repository)
    {
        // TODO: Implement loadContributorDataForRepository() method.
    }

    private function fetchAllRepositoryDataForUser(ApiInterface $api, ResultPagerInterface $paginator, User $user)
    {
        return $this->fetchAllData($api, $paginator, [$user->getLowerCaseUsername()]);
    }

    private function fetchAllData(ApiInterface $api, ResultPagerInterface $paginator, array $parameters)
    {
        $data = $paginator->fetch($api, 'repositories', $parameters);
        $count = 1;

        while ($paginator->hasNext()) {
            $data = array_merge($data, $paginator->fetchNext());
            $count++;
        }
        return $data;
    }
}