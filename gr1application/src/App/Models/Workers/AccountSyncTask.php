<?php

namespace App\Models\Workers;

use App\Workers\Executers\AccountSyncWorker;
use App\Workers\Model\Interfaces\TaskInterface;

class AccountSyncTask implements TaskInterface
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getTaskName(): string
    {
        return AccountSyncWorker::QUEUE;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }


}
