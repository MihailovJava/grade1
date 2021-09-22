<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestTokenHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new RequestTokenHandler($container->get(AmoCRMApiClient::class));
    }
}
