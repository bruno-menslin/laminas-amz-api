<?php

namespace Locations\V1\Rest\Local;

use Locations\V1\Rest\Local\LocalMapper;

class LocalResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get(LocalMapper::class); // servico criado em Module.php
        return new LocalResource($mapper);
    }
}
