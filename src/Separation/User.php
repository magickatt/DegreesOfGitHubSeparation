<?php

namespace Separation;

class User
{
    /** @var string */
    private $username;

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
        $this->username = $name;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getLowerCaseUsername()
    {
        return strtolower($this->username);
    }
}
