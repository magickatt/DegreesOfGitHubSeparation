<?php

namespace Separation;

class Repository
{
    /** @var string */
    private $name;

    /** @var array */
    private $users = [];

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

    public function setContributors(array $users)
    {
        $this->users = $users;
    }

    public function getContributors()
    {
        return $this->users;
    }
}
