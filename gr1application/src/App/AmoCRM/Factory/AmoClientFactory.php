<?php

namespace App\AmoCRM\Factory;

use AmoCRM\Client\AmoCRMApiClient;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AmoClientFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): AmoCRMApiClient
    {
        $config = $container->get('config');
        $clientId = $config['oauth']['client_uuid'];
        $clientSecret = $config['oauth']['client_secret'];

        return new AmoCRMApiClient($clientId, $clientSecret, $config['oauth']['redirect_uri']);
    }

}