<?php

namespace Synaptio\DI\Reflection\Constructor;

use JetBrains\PhpStorm\Pure;
use ReflectionMethod;
use ReflectionParameter;
use Synaptio\DI\DIContainer;
use Synaptio\DI\Reflection\Constructor\DTO\DefaultValueConstructorParameters;
use Synaptio\DI\Reflection\Constructor\DTO\ConstructorParameters;

class ParamsConstructor implements Constructor
{
    public function __construct(
        private ReflectionMethod $constructor
    ) {}

    /**
     * @return ConstructorParameters[]
     * @throws \ReflectionException
     */
    #[Pure] public function resolveParameters(array $bindings): array
    {
        $parameters = $this->constructor->getParameters();
        $parametersDTO = [];
        foreach ($parameters as $parameter) {
            $defaultValueConstructorParameters = null;
            if ($parameter->isDefaultValueAvailable()) {
                $defaultValueConstructorParameters = $this->getDefaultValueConstructorParameters($parameter);
            }
            $parametersDTO[] = $this->getRequireConstructorParameters($parameter, $defaultValueConstructorParameters);
        }
        return $parametersDTO;
    }

    private function getDefaultValueConstructorParameters(ReflectionParameter $parameter): DefaultValueConstructorParameters
    {
        $default = $parameter->getDefaultValue();
        $constant = null;
        if ($parameter->isDefaultValueConstant()) {
            $constant = $parameter->getDefaultValueConstantName();
        }
        return new DefaultValueConstructorParameters($default, $constant);
    }

    private function getRequireConstructorParameters(
        ReflectionParameter $parameter,
        ?DefaultValueConstructorParameters $defaultValueConstructorParameters
    ): ConstructorParameters
    {
        return new ConstructorParameters(
            $parameter->getName(),
            $parameter->getType(),
            $parameter->getPosition(),
            $defaultValueConstructorParameters
        );
    }
}