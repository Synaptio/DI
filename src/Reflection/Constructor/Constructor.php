<?php

namespace Synaptio\DI\Reflection\Constructor;

use Synaptio\DI\Reflection\Constructor\DTO\ConstructorParameters;

interface Constructor
{
    /**
     * @return ConstructorParameters[]
     */
    public function resolveParameters(): array;
}