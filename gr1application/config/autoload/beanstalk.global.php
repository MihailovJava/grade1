<?php

declare(strict_types=1);

return [
    'beanstalk' => [
        'host' => getenv('BEANSTALK_HOST'),
        'port' => (int)getenv('BEANSTALK_PORT') ?: 11300,
        'timeout' => (int)getenv('BEANSTALK_TIMEOUT') ?: 5,
    ],
];
