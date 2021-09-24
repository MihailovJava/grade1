<?php

declare(strict_types=1);

namespace App\Handler;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\ORM\UserModel;
use App\Models\Workers\AccountSyncTask;
use App\Workers\Model\Beanstalk;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestTokenHandler implements RequestHandlerInterface
{


    public AmoCRMApiClient $client;
    private Beanstalk $beanstalk;


    public function __construct(
        AmoCRMApiClient $client,
        Beanstalk       $beanstalk
    ) {
        $this->client = $client;
        $this->beanstalk = $beanstalk;

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $user = UserModel::query()
            ->first();

        if ($user) {
            $accessToken = $user->getAttribute('token');
            $this->beanstalk->send(
                new AccountSyncTask(
                    ['token' => $accessToken]
                )
            );
            return new JsonResponse($user);
        }


        $authorizationUrl = $this->client->getOAuthClient()->getAuthorizeUrl([
            'state' => '123',
            'mode' => 'post_message',
        ]);
        header('Location: ' . $authorizationUrl);


        die;
    }
}
