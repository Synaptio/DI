<?php

namespace Synaptio\DI\Domain\Resolve;

use Synaptio\DI\DIContainer;
use Synaptio\DI\Domain\Resolve\Exceptions\ResolveException;
use Synaptio\DI\Reflection\Constructor\DTO\ConstructorParameters;
use Synaptio\DI\Tree\RecursiveClassChecker;

class ParametersResolver
{
    public function __construct(
        private ConstructorParameters $constructorParameters
    )
    {}

    public function resolve(array $params, RecursiveClassChecker $recursiveClassChecker): mixed
    {
        $constructorParameters = $this->constructorParameters;
        if (class_exists($constructorParameters->getType())) {
           return DIContainer::make($constructorParameters->getType(), [], $recursiveClassChecker);
        }

        if (isset($params[$constructorParameters->getName()])) {
            return $params[$constructorParameters->getName()];
        }
        if (isset($params[$constructorParameters->getPosition()])) {
            return $params[$constructorParameters->getPosition()];
        }

        if ($this->constructorParameters->getDefaultValueConstructorParameters() !== null) {
            return $this->constructorParameters->getDefaultValueConstructorParameters()->getDefault();
        }
        throw new ResolveException(sprintf('Param %s haven\\\t default value.',
            $this->constructorParameters->getName()
        ));
    }

}