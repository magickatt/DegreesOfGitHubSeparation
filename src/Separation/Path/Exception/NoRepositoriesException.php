<?php

namespace Separation\Path\Exception;

use Separation\User;

class NoRepositoriesException extends \Exception
{
    /** @var User */
    private $user;

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}