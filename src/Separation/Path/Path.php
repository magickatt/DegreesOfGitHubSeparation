<?php

namespace Separation\Path;

use PhpCollection\Sequence;
use Separation\User;

class Path
{
    private $user1;

    private $user2;

    private $repositories;

    public function __construct(User $user1, User $user2, Sequence $repositories)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->repositories = $repositories;
    }

    public function shortestDistance()
    {
        return count($this->repositories);
    }

    public function getRepositories()
    {
        return $this->repositories;
    }

    public function getUser1()
    {
        return $this->user1;
    }

    public function getUser2()
    {
        return $this->user2;
    }
}
