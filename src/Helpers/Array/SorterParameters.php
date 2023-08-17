<?php

namespace Synaptio\DI\Helpers\Array;

class SorterParameters
{
    public function __construct(
        private array $params
    )
    {}

    public function sort(): array
    {
        $sortParams = [];
        $iterator = -1;
        foreach ($this->params as $key => $param) {
            $iterator++;
            if (is_int($key)) {
                $sortParams[$iterator] = $param;
                continue;
            }
            $sortParams[$key] = $param;
        }
        return $sortParams;
    }
}