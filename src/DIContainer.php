<?php

namespace Synaptio\DI;

use ReflectionClass;
use Synaptio\DI\Exceptions\ClassNotFound;
use Synaptio\DI\Reflection\Constructor\CreateConstructor;

class DIContainer
{
    private static array $bindings = [];

    public static function make(string $className, array $bindings = []): object
    {
        if (!class_exists($className)) {
            throw new ClassNotFound($className);
        }
        $constructor = new CreateConstructor($className);
        $parameters = $constructor->resolveParameters($bindings);

        return new $className(...$parameters);
    }
}