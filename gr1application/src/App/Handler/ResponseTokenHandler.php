<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class ResponseTokenHandler implements RequestHandlerInterface
{

    private AmoCRMApiClient $apiClient;

    public function __construct(AmoCRMApiClient $client)
    {
        $this->apiClient = $client;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
//        return new JsonResponse(['ack' => time()]);
        /**
         * Ловим обратный код
         */
        try {
            $apiClient = $this->apiClient;

            if (isset($_GET['referer'])) {
                $apiClient->setAccountBaseDomain($_GET['referer']);
            }

            $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);

        } catch (Exception $e) {
            die((string)$e);
        }

        $ownerDetails = $apiClient->getOAuthClient()->getResourceOwner($accessToken);

        return new HtmlResponse(sprintf(
            '<h1>Hello %s</h1>',
            $ownerDetails->getName()
        ));
    }
}
