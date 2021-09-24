<?php

namespace App\Handler;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ListOfAccountHandlerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ListOfAccountHandler
    {
        return new ListOfAccountHandler();
    }
}