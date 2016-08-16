<?php

namespace Separation;

use PhpCollection\Sequence;

class Repository
{
    /** @var string */
    private $name;

    /** @var Sequence */
    private $users;

    /**
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->getUsername();
        } catch (\Exception $exception) {
            return '';
        }
    }

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Sequence $users
     */
    public function setContributors(Sequence $users)
    {
        $this->users = $users;
    }

    /**
     * @return Sequence
     */
    public function getContributors()
    {
        return $this->users;
    }
}
