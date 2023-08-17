<?php

namespace Synaptio\DI;

class Singletone
{
    private static array $container = [];

    public static function make(string $className, ...$args): object
    {
        if (!isset(self::$container[$className])) {
            self::$container[$className] = DIContainer::make($className, $args);
        }
        return self::$container[$className];
    }
}