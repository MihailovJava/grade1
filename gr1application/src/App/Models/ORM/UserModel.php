<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

}