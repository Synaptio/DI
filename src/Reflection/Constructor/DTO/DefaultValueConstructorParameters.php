<?php

namespace Synaptio\DI\Reflection\Constructor\DTO;

class DefaultValueConstructorParameters
{
    public function __construct(
        private mixed $default,
        private ?string $constant,
    ){}

    public function getDefault(): mixed
    {
        return $this->default;
    }

    public function getConstant(): ?string
    {
        return $this->constant;
    }
}