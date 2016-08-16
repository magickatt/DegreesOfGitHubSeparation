<?php

namespace Separation\Path;

use Separation\Path\Adapter\AdapterInterface;

class PathResolver
{
    private $adapter;

    private $pathFactory;

    public function __construct(AdapterInterface $adapter, PathFactory $pathFactory)
    {
        $this->adapter = $adapter;
        $this->pathFactory = $pathFactory;
    }
}
