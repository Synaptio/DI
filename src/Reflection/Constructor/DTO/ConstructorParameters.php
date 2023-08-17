<?php

namespace Synaptio\DI\Reflection\Constructor\DTO;

use Synaptio\DI\Infractructure\DTO\DTO;

class ConstructorParameters
{
    public function __construct(
        private string $name,
        private string $type,
        private int $position,
        private ?DefaultValueConstructorParameters $defaultValueConstructorParameters = null
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getDefaultValueConstructorParameters(): ?DefaultValueConstructorParameters
    {
        return $this->defaultValueConstructorParameters;
    }
}