<?php

namespace App\Workers\Model\Interfaces;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

interface TaskInterface extends JsonSerializable, Arrayable
{
    public function getTaskName(): string;
}
