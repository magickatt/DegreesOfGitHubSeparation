<?php

namespace Separation;

use PhpCollection\Sequence;
use Separation\Path\Path;

class ResponsePayload
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function generatePayload()
    {
        return [
            'data' => [
                'distance' => $this->path->shortestDistance(),
                'path' => $this->formatPath($this->path->getRepositories())
            ],
            'metadata' => [

            ]
        ];
    }

    private function formatPath(Sequence $repositories)
    {
        $path = [];
        foreach ($repositories as $repository) {
            $path[] = $repository->getName();
        }
        return $path;
    }
}
