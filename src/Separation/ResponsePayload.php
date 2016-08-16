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
                'user1' => $this->path->getUser1()->getUsername(),
                'user2' => $this->path->getUser2()->getUsername()
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
