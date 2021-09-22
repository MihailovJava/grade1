<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResponseTokenHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new ResponseTokenHandler($container->get(AmoCRMApiClient::class));
    }
}
