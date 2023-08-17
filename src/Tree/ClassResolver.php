<?php

namespace Synaptio\DI\Tree;

class ClassResolver
{
    public function __construct(
        private array $binding,
        private string $className
    ){}

    public function resolve()
    {
        return $this->binding[$this->className] ?? $this->className;
    }
}