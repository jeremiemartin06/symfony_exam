<?php

namespace App\Serializer;

class CircularReferenceHandler
{
    public function __invoke($project)
    {
        return $project->getId();
    }
}