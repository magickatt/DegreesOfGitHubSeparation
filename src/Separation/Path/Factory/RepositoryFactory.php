<?php

namespace Separation\Path\Factory;

use Separation\Repository;

class RepositoryFactory
{
    const NAME_KEY = 'full_name';

    /**
     * Create a repository from an array of data
     * @param array $data
     * @return Repository
     */
    public function createFromData(array $data)
    {
        if (array_key_exists(self::NAME_KEY, $data)) {
            return new Repository($data[self::NAME_KEY]);
        }
    }
}
