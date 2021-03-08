<?php
namespace Locations\V1\Rpc\LocalType;

class LocalTypeControllerFactory
{
    public function __invoke($controllers)
    {
        return new LocalTypeController();
    }
}
