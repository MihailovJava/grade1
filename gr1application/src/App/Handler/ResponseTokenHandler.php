<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\UserModel;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

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

        $user = (new UserModel())
            ->setAttribute('uuid', Uuid::uuid4()->toString())
            ->setAttribute('token', $accessToken)
            ->setAttribute('name', $ownerDetails->getName());


        $user->save();


        return new JsonResponse($user);
    }
}
