<?php

namespace Synaptio\DI\Reflection\Constructor;

use JetBrains\PhpStorm\Pure;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;
use Synaptio\DI\DIContainer;
use Synaptio\DI\Domain\Resolve\ParametersResolver;
use Synaptio\DI\Tree\RecursiveClassChecker;

class CreateConstructor
{
    private Constructor $constructor;

    public function __construct(string $className)
    {
        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            $this->constructor = new EmptyConstructor();
        } else {
            $this->constructor = new ParamsConstructor($reflection->getConstructor());
        }
    }

    /**
     * @return ReflectionParameter[]
     */
    public function resolveParameters(RecursiveClassChecker $recursiveClassChecker): array
    {
        $paramsMap = [];
        $parameters = $this->constructor->resolveParameters();
        foreach ($parameters as $parameter) {
            $paramsMap[] = (new ParametersResolver($parameter))->resolve($recursiveClassChecker);
        }
        return $paramsMap;
    }
}