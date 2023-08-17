<?php

namespace Synaptio\DI;

use ReflectionClass;
use Synaptio\DI\Exceptions\ClassNotFound;
use Synaptio\DI\Exceptions\RecursiveClass;
use Synaptio\DI\Reflection\Constructor\CreateConstructor;
use Synaptio\DI\Tree\ClassResolver;
use Synaptio\DI\Tree\RecursiveClassChecker;

class DIContainer
{
    private static array $bindings = [];

    public static function setBindingsMap(array $bindings)
    {
        self::$bindings = $bindings;
    }

    public static function make(string $className, array $params = [], ?RecursiveClassChecker $recursiveClassChecker = null): object
    {
        $className = (new ClassResolver(self::$bindings, $className))->resolve();
        if (!class_exists($className)) {
            throw new ClassNotFound($className);
        }
        if ($recursiveClassChecker === null) {
            $recursiveClassChecker = new RecursiveClassChecker();
        }
        if ($recursiveClassChecker->isExistInClassMap($className)) {
            throw new RecursiveClass($className);
        }
        $constructor = new CreateConstructor($className);
        $parameters = $constructor->resolveParameters($params, $recursiveClassChecker);

        return new $className(...$parameters);
    }
}