<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    protected $table = 'accounts';

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

}