<?php

namespace Separation;

use PhpCollection\Sequence;

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
}
