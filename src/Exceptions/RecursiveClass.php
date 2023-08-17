<?php

namespace Synaptio\DI\Exceptions;

use RuntimeException;

class RecursiveClass extends RuntimeException
{
    public function __construct(string $className = "")
    {
        parent::__construct(sprintf('Class %s is recursive.', $className));
    }
}