<?php


declare(strict_types=1);

return [
    'oauth' => [
        'promo_url' => getenv('AMOCRM_PROMO_URL') ?: 'www.amocrm.ru',
        'client_uuid' => getenv('AMOCRM_CLIENT_ID') ?: '',
        'client_secret' => getenv('AMOCRM_CLIENT_SECRET') ?: '',
        'redirect_uri' => getenv('AMOCRM_REDIRECT_URI') ?: '',
    ],
    'trusted_oauth' => [
        'promo_url' => getenv('AMOCRM_PROMO_URL') ?: 'www.amocrm.ru',
        'client_uuid' => getenv('AMOCRM_RPA_CLIENT_ID') ?: '',
        'client_secret' => getenv('AMOCRM_RPA_CLIENT_SECRET') ?: '',
        'redirect_uri' => getenv('AMOCRM_RPA_REDIRECT_URI') ?: '',
    ],
];
