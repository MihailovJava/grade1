<?php

namespace App\Workers;

use App\Workers\Config\BeanstalkConfig;
use App\Workers\Executers\AccountSyncWorker;
use App\Workers\Factory\AccountSyncWorkerFactory;
use App\Workers\Factory\BeanstalkConfigFactory;
use App\Workers\Model\Beanstalk;
use App\Workers\Model\BeanstalkFactory;

class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'laminas-cli' => $this->getCliConfig(),
        ];
    }

    public function getCliConfig() : array
    {
        return [
            'commands' => [
                AccountSyncWorker::NAME =>  AccountSyncWorker::class
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                BeanstalkConfig::class => BeanstalkConfigFactory::class,
                AccountSyncWorker::class => AccountSyncWorkerFactory::class,
                Beanstalk::class => BeanstalkFactory::class,
            ],
        ];
    }

}