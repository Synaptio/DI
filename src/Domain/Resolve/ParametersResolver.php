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

    public function resolve(RecursiveClassChecker $recursiveClassChecker): mixed
    {
        if (!class_exists($this->constructorParameters->getType())) {
            if ($this->constructorParameters->getDefaultValueConstructorParameters() === null) {
                throw new ResolveException(sprintf('Param %s haven\\\t default value.',
                    $this->constructorParameters->getName()
                ));
            }

            return $this->constructorParameters->getDefaultValueConstructorParameters()->getDefault();
        }

        return DIContainer::make($this->constructorParameters->getType(), $recursiveClassChecker);
    }

}