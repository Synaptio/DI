<?php

namespace Synaptio\DI\Exceptions;

use RuntimeException;

class ClassNotFound extends RuntimeException
{
    public function __construct(string $className = "")
    {
        parent::__construct(sprintf('Class %s not found.', $className), 404);
    }
}