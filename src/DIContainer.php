<?php

namespace Synaptio\DI;

use ReflectionClass;
use Synaptio\DI\Exceptions\ClassNotFound;
use Synaptio\DI\Reflection\Constructor\CreateConstructor;
use Synaptio\DI\Tree\ClassResolver;

class DIContainer
{
    private static array $bindings = [];

    public static function setBindingsMap(array $bindings)
    {
        self::$bindings = $bindings;
    }

    public static function make(string $className): object
    {
        $className = (new ClassResolver(self::$bindings, $className))->resolve();
        if (!class_exists($className)) {
            throw new ClassNotFound($className);
        }
        $constructor = new CreateConstructor($className);
        $parameters = $constructor->resolveParameters();

        return new $className(...$parameters);
    }
}