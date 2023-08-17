<?php

namespace Synaptio\DI\Tree;

class RecursiveClassChecker
{
    private array $map = [];

    public function isExistInClassMap(string $className): bool
    {
        if (isset($this->map[$className])) {
            return true;
        }
        $this->map[$className] = $className;
        return false;
    }
}