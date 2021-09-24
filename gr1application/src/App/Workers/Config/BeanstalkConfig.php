<?php

namespace App\Workers\Config;


class BeanstalkConfig
{
    /** @var string */
    protected string $host;
    /** @var int */
    protected int $port;
    /** @var int */
    protected int $timeout;

    /**
     * @param string $host
     * @param int    $port
     * @param int    $timeout
     */
    public function __construct(string $host, int $port, int $timeout)
    {
        $this->host       = $host;
        $this->port       = $port;
        $this->timeout    = $timeout;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
}
