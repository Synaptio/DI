<?php

namespace Synaptio\DI\Reflection\Constructor;

use Synaptio\DI\Reflection\Constructor\DTO\ConstructorParameters;

class EmptyConstructor implements Constructor
{
    /**
     * @return ConstructorParameters[]
     */
    public function resolveParameters(array $bindings): array
    {
        return [];
    }
}