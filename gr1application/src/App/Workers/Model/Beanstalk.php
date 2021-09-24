<?php

namespace App\Workers\Model;

use App\Workers\Config\BeanstalkConfig;
use App\Workers\Model\Interfaces\TaskInterface;
use Pheanstalk\Pheanstalk;

class Beanstalk
{
    protected BeanstalkConfig $config;
    protected ?Pheanstalk $connect = null;

    public function __construct(BeanstalkConfig $config)
    {
        $this->config = $config;
    }


    public function send(TaskInterface $task): void
    {
        $connect = $this->getConnect();

        $connect->useTube($task->getTaskName());
        $connect->put(json_encode($task, JSON_THROW_ON_ERROR));
    }

    public function getConnect(): Pheanstalk
    {
        if ($this->connect === null) {
            $this->connect = Pheanstalk::create(
                $this->config->getHost(),
                $this->config->getPort(),
                $this->config->getTimeout(),
            );
        }

        return $this->connect;
    }


}