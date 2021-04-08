<?php

namespace App\Serializer;

class MaxDepthHandler
{
    public function __invoke($project)
    {
        return 'MaxDepth';
    }
}