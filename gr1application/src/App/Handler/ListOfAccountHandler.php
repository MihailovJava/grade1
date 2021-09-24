<?php

namespace App\Handler;

use App\Models\ORM\AccountModel;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListOfAccountHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $account = AccountModel::query()
            ->first();

        if ($account) {

            return new JsonResponse(['response' => $account]);
        }
        return new JsonResponse(['response' => 'none']);
    }
}