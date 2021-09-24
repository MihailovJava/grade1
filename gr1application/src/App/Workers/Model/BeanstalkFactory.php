<?php

namespace App\Workers\Model;

use App\Workers\Config\BeanstalkConfig;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BeanstalkFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null) : Beanstalk
    {
        return new Beanstalk($container->get(BeanstalkConfig::class));
    }


}