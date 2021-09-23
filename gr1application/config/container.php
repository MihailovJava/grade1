<?php

declare(strict_types=1);

use Illuminate\Container\Container;
use Laminas\ServiceManager\ServiceManager;
use Illuminate\Database\Capsule\Manager;


// Load configuration
$config = require __DIR__ . '/config.php';

$dependencies                       = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
$container = new ServiceManager($dependencies);

$capsule = new Manager();
$capsuleContainer = $capsule->getContainer();
$capsule->addConnection($config['database'], 'main');
$capsule->getDatabaseManager()->setDefaultConnection('main');
$capsule->bootEloquent();


return $container;
