<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use \Phpmig\Adapter;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;

$container = new ArrayObject();

$config = require __DIR__ . '/config/config.php';
$container = new Container();

$container['config'] = $config;

$container['db'] = function ($c) {
    $capsule = new Manager();
    $capsule->addConnection($c['config']['database'], 'main');
    $capsule->getDatabaseManager()->setDefaultConnection('main');
    $capsule->bootEloquent();
    $capsule->setAsGlobal();

    return $capsule;
};

$container['phpmig.adapter'] = function ($c) {
    return new Adapter\Illuminate\Database($c['db'], 'migrations');
};
$container['phpmig.migrations_path'] = __DIR__ . '/migrations';


return $container;