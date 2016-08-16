<?php

namespace Separation\Payload;

interface PayloadInterface
{
    /**
     * Generate information about the path found or explain why it may not have been found
     * @return array
     */
    public function generatePayload();
}