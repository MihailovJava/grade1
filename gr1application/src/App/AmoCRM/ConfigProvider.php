<?php

namespace App\AmoCRM;

use AmoCRM\Client\AmoCRMApiClient;
use App\AmoCRM\Factory\AmoClientFactory;

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
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [],
            'factories'  => [
                AmoCRMApiClient::class => AmoClientFactory::class,
            ],
        ];
    }
}
