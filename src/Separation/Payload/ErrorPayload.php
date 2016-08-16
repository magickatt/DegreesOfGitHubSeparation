<?php

namespace Separation\Payload;

use PhpCollection\Sequence;
use Separation\Path\Exception\PathException;
use Separation\Path\Path;

class ErrorPayload implements PayloadInterface
{
    /** @var PathException */
    private $exception;

    /**
     * ErrorPayload constructor
     * @param PathException $exception
     */
    public function __construct(PathException $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @inheritdoc
     */
    public function generatePayload()
    {
        return [
            'error' => $this->exception->getMessage()
        ];
    }
}
