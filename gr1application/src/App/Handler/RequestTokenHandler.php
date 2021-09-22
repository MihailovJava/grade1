<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestTokenHandler implements RequestHandlerInterface
{


    public AmoCRMApiClient $client;


    public function __construct(AmoCRMApiClient $client)
    {
        $this->client = $client;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $authorizationUrl = $this->client->getOAuthClient()->getAuthorizeUrl([
            'state' => '123',
            'mode' => 'post_message',
        ]);
        header('Location: ' . $authorizationUrl);


        die;
    }
}
