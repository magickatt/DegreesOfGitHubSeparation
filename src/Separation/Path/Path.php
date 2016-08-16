<?php

namespace Separation\Path;

use PhpCollection\Sequence;
use Separation\User;

class Path
{
    /** @var User */
    private $user1;

    /** @var User */
    private $user2;

    /** @var Sequence */
    private $repositories;

    /**
     * Path constructor
     * @param User $user1
     * @param User $user2
     * @param Sequence $repositories
     */
    public function __construct(User $user1, User $user2, Sequence $repositories)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->repositories = $repositories;
    }

    /**
     * Shortest distance of path (in hops between repositories)
     * @return int
     */
    public function shortestDistance()
    {
        return count($this->repositories);
    }

    /**
     * @return Sequence
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * @return User
     */
    public function getUser1()
    {
        return $this->user1;
    }

    /**
     * @return User
     */
    public function getUser2()
    {
        return $this->user2;
    }
}
