#!/usr/bin/env php
<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\ConsoleOutput;

require __DIR__ . '/../vendor/autoload.php';

(static function () {
    /** @var ContainerInterface $container */
    $container = require __DIR__ . '/../config/container.php';

    $config = $container->get('config');
    $application = new Application();
    $commands = $config['dependencies']['commands'] ?? [];

    try {
        foreach ($commands as $command) {
            $application->add($container->get($command));
        }

        $application->run();
    } catch (Exception $ex) {
        $output = new ConsoleOutput();
        $output->writeln('<error>' . $ex . '</error>');
    }
})();
