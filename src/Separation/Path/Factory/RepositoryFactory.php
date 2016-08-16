<?php

namespace Separation\Path\Factory;

use Separation\Repository;

class RepositoryFactory
{
    const NAME_KEY = 'name';

    public function createFromData(array $data)
    {
        if (array_key_exists(self::NAME_KEY, $data)) {
            return new Repository($data[self::NAME_KEY]);
        }
    }
}
