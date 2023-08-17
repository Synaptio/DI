<?php

namespace Synaptio\DI\Reflection\Constructor;

use Synaptio\DI\Reflection\Constructor\DTO\ConstructorParameters;
use Synaptio\DI\Tree\RecursiveClassChecker;

class EmptyConstructor implements Constructor
{
    /**
     * @return ConstructorParameters[]
     */
    public function resolveParameters(): array
    {
        return [];
    }
}