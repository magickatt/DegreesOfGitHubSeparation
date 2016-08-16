<?php

namespace Separation\Path\Factory;

use Separation\User;

class UserFactory
{
    const LOGIN_KEY = 'login';

    /**
     * Create a user from an array of data
     * @param array $data
     * @return User
     */
    public function createFromData(array $data)
    {
        if (array_key_exists(self::LOGIN_KEY, $data)) {
            return new User($data[self::LOGIN_KEY]);
        }
    }
}
