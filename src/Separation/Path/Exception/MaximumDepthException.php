<?php

namespace Separation\Path\Exception;

class MaximumDepthException extends PathException
{
    /** @var int */
    private $maximumDepth;

    /**
     * @return int
     */
    public function getMaximumDepth()
    {
        return $this->maximumDepth;
    }

    /**
     * @param int $maximumDepth
     */
    public function setMaximumDepth($maximumDepth)
    {
        $this->maximumDepth = $maximumDepth;
    }
}