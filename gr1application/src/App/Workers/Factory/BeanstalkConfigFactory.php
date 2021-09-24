<?php

namespace App\Workers\Factory;

use App\Workers\Config\BeanstalkConfig;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class BeanstalkConfigFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): BeanstalkConfig
    {
        return new BeanstalkConfig(...array_values($container->get('config')['beanstalk']));
    }


}