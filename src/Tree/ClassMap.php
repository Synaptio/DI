<?php

namespace Synaptio\DI\Tree;

interface ClassMap
{
    public function add(string $className, array $stack);
}