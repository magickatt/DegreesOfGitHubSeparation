<?php

namespace Separation\Path;

use PhpCollection\Map;
use PhpCollection\Sequence;
use Separation\Path\Api\Api;
use Separation\Path\Exception\MaximumDepthException;
use Separation\Path\Exception\NoPathException;
use Separation\Path\Exception\NoRepositoriesException;
use Separation\Path\Factory\PathFactory;
use Separation\Path\Storage\Storage;
use Separation\Repository;
use Separation\User;

class PathResolver
{
    /** @var int */
    private $maximumTraversalDepth = 10;

    /** @var Api */
    private $api;

    /** @var Storage */
    private $storage;

    /** @var PathFactory */
    private $pathFactory;

    /**
     * PathResolver constructor
     * @param Api $api
     * @param Storage $storage
     * @param PathFactory $pathFactory
     */
    public function __construct(Api $api, Storage $storage, PathFactory $pathFactory)
    {
        $this->api = $api;
        $this->storage = $storage;
        $this->pathFactory = $pathFactory;
    }

    /**
     * Resolve a path of repositories between 2 given users
     * @param User $user1
     * @param User $user2
     * @return Path
     */
    public function resolvePathBetweenUsers(User $user1, User $user2)
    {
        $repositories = $this->traverseUsersAndRepositoriesToFindShortestPath($user1, $user2);
        return $this->pathFactory->create($user1, $user2, $repositories);
    }

    /**
     * Traverse users (starting from user1) until first instance of user2 as a contributed has been located
     * @param User $user1
     * @param User $user2
     * @return Path|null
     * @throws MaximumDepthException
     * @throws NoPathException
     */
    private function traverseUsersAndRepositoriesToFindShortestPath(User $user1, User $user2)
    {
        $depth = 0;
        $currentRepositories = $this->findRepositoriesForUserAndStore($user1);

        do {

            $nextRepositories = $this->findContributorsAndTheirRepositories($currentRepositories);
            if ($this->storage->doesUserExist($user2)) {
                return $this->storage->getShortestPathOfRepositoriesBetweenUsers($user1, $user2);
            }

            $depth++;
            $currentRepositories = $this->reduceRepositoryMapToSequence($nextRepositories);

        } while (!$currentRepositories->isEmpty() && $depth <= $this->maximumTraversalDepth);

        if ($depth >= $this->maximumTraversalDepth) {
            throw new MaximumDepthException('Path could not be found at a maximum traversal depth of '.$depth);
        }
        throw new NoPathException('Path could not be found between '.$user1.' and '.$user2);
    }

    /**
     * Find contributors of a repository and then find their repositories while storing these relationships
     * @param Sequence $currentRepositories
     * @return Map
     */
    private function findContributorsAndTheirRepositories(Sequence $currentRepositories)
    {
        $nextRepositories = new Map();

        /** @var Repository $repository */
        foreach ($currentRepositories as $repository) {

            $users = $this->api->getContributorsForRepository($repository);
            $repository->setContributors($users);

            foreach ($users as $user) {
                try {
                    $nextRepositories->set($user->getUsername(), $this->findRepositoriesForUserAndStore($user));
                } catch (NoRepositoriesException $exception) {
                    continue;
                }
            }

        }

        return $nextRepositories;
    }

    /**
     * Find repositories belonging to a given user and store these relationships
     * @param User $user
     * @return Sequence
     * @throws NoRepositoriesException
     */
    private function findRepositoriesForUserAndStore(User $user)
    {
        $repositories = $this->api->getRepositoriesForUser($user);
        if ($repositories->isEmpty()) {
            throw new NoRepositoriesException('Path could not be found as '.$user.' has no repositories to traverse');
        }

        $this->storage->storeRepositoriesAsContributedByUser($user, $repositories);
        return $repositories;
    }

    /**
     * Flatten the next iteration of repositories to traverse
     *
     * Idea was to traverse nodes horizontally (instead of hitting maximum depth on each branch before progressing)
     * to prevent performance degrading exponentially if maximum depth was increased. To increase performance using a
     * graphing database as storage could delay the user2 query until all relationships have been stored
     *
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
