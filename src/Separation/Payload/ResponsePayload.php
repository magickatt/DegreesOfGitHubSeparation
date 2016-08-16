<?php

namespace Separation\Payload;

use PhpCollection\Sequence;
use Separation\Path\Path;

class ResponsePayload implements PayloadInterface
{
    /** @var Path */
    private $path;

    /**
     * ResponsePayload constructor
     * @param Path $path
     */
    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Format path to be displayed in the payload
     * @param Sequence $repositories
     * @return array
     */
    private function formatPath(Sequence $repositories)
    {
        $path = [];
        foreach ($repositories as $repository) {
            $path[] = $repository->getName();
        }
        return $path;
    }
}
