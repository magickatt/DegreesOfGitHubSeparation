<?php

namespace Separation\Path;

use PhpCollection\Map;
use PhpCollection\Sequence;
use Separation\Path\Adapter\Api\AdapterInterface as ApiAdapterInterface;
use Separation\Path\Adapter\Graph\AdapterInterface as GraphAdapterInterface;
use Separation\Path\Exception\MaximumDepthException;
use Separation\Path\Exception\NoPathException;
use Separation\Path\Exception\NoRepositoriesException;
use Separation\Path\Factory\PathFactory;
use Separation\Repository;
use Separation\User;

class PathResolver
{
    private $maximumTraversalDepth = 10;

    private $apiAdapter;

    private $graphAdapter;

    private $pathFactory;

    public function __construct(ApiAdapterInterface $apiAdapter, GraphAdapterInterface $graphAdapter, PathFactory $pathFactory)
    {
        $this->apiAdapter = $apiAdapter;
        $this->graphAdapter = $graphAdapter;
        $this->pathFactory = $pathFactory;
    }

    public function resolvePathBetweenUsers(User $user1, User $user2)
    {
        $repositories = $this->traverseUsersAndRepositoriesToFindShortestPath($user1, $user2);
        return $this->pathFactory->create($user1, $user2, $repositories);
    }

    private function traverseUsersAndRepositoriesToFindShortestPath(User $user1, User $user2)
    {
        $depth = 0;
        $currentRepositories = $this->findRepositoriesForUserAndStore($user1);

        do {

            $nextRepositories = new Map();
            /** @var Repository $repository */
            foreach ($currentRepositories as $repository) {

                $users = $this->apiAdapter->getContributorsForRepository($repository);
                $repository->setContributors($users);

                foreach ($users as $user) {
                    try {
                        $nextRepositories->set($user->getUsername(), $this->findRepositoriesForUserAndStore($user));
                    } catch (NoRepositoriesException $exception) {
                        // Assuming there will be at least 1 user with repositories (if not NoPathException applies)
                        continue;
                    }
                }

                if ($this->graphAdapter->doesUserExist($user2)) {
                    return $this->graphAdapter->getShortestPathOfRepositoriesBetweenUsers($user1, $user2);
                }

            }

            $depth++;
            $currentRepositories = $this->reduceRepositoryMapToSequence($nextRepositories);

        } while (!empty($currentRepositories) && $depth <= $this->maximumTraversalDepth);

        if ($depth >= $this->maximumTraversalDepth) {
            throw new MaximumDepthException('Path could not be found at a maximum traversal depth of '.$depth);
        }
        throw new NoPathException('Path could not be found between '.$user1.' and '.$user2);
    }

    private function findRepositoriesForUserAndStore(User $user)
    {
        $repositories = $this->apiAdapter->getRepositoriesForUser($user);
        if (empty($repositories)) {
            throw new NoRepositoriesException('Path could not be found as '.$user.' has no repositories to traverse');
        }

        $this->graphAdapter->storeRepositoriesAsContributedByUser($user, $repositories);
        return $repositories;
    }

    /**
     * @todo Dedupe repositories at reduction time
     * @param Map $map
     * @return Sequence
     */
    private function reduceRepositoryMapToSequence(Map $map)
    {
        $sequence = new Sequence();
        /**
         * @var string $username
         * @var Sequence $repositories
         */
        foreach ($map as $username => $repositories) {
            $sequence->addAll($repositories->all());
        }
        return $sequence;
    }
}
