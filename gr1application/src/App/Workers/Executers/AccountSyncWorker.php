<?php

namespace App\Workers\Executers;


use AmoCRM\Client\AmoCRMApiClient;
use App\Models\ORM\AccountModel;
use App\Workers\Model\Beanstalk;
use League\OAuth2\Client\Token\AccessToken;
use Ramsey\Uuid\Uuid;

class AccountSyncWorker extends BeanstalkWorker
{

    public const NAME = 'crm:worker:account_sync';
    public const QUEUE = 'account_sync';

    private AmoCRMApiClient $apiClient;


    public function __construct(Beanstalk $queue, AmoCRMApiClient $apiClient)
    {
        parent::__construct($queue);
        $this->apiClient = $apiClient;
    }

    protected function myName(): string
    {
        return self::NAME;
    }

    /**
     * @param array $job
     *
     */
    protected function process(array $job): void
    {
        $token = $job['token'];
        $this->apiClient->setAccessToken(
            new AccessToken(['access_token' => $token])
        );
        $account = $this->apiClient->account()->getCurrent();
        if ($account) {
            $accountModel = (new AccountModel())
                ->setAttribute('uuid', Uuid::uuid4()->toString())
                ->setAttribute('subdomain', $account->getSubdomain())
                ->setAttribute('name', $account->getName());

            $accountModel->save();
        }

        echo $job;
    }

}