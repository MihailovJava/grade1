<?php

namespace App\Workers\Factory;

use AmoCRM\Client\AmoCRMApiClient;
use App\Workers\Executers\AccountSyncWorker;
use App\Workers\Model\Beanstalk;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AccountSyncWorkerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): AccountSyncWorker
    {
        return new AccountSyncWorker(
            $container->get(Beanstalk::class),
            $container->get(AmoCRMApiClient::class)
        );
    }
}