<?php

namespace Separation\Payload;

use PhpCollection\Sequence;
use Separation\Path\Exception\PathException;
use Separation\Path\Path;

class ErrorPayload implements PayloadInterface
{
    private $exception;

    public function __construct(PathException $exception)
    {
        $this->exception = $exception;
    }

    public function generatePayload()
    {
        return [
            'error' => $this->exception->getMessage()
        ];
    }
}
