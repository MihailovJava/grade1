<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\ORM\UserModel;
use App\Models\Workers\AccountSyncTask;
use App\Workers\Model\Beanstalk;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

class ResponseTokenHandler implements RequestHandlerInterface
{

    private AmoCRMApiClient $apiClient;
    private Beanstalk $beanstalk;

    public function __construct(
        AmoCRMApiClient $client,
        Beanstalk       $beanstalk
    )
    {
        $this->apiClient = $client;
        $this->beanstalk = $beanstalk;
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

        $this->beanstalk->send(
            new AccountSyncTask(
                ['token' => $accessToken]
            )
        );
        return new JsonResponse($user);
    }
}
