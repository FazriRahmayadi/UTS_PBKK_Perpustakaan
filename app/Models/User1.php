<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User1 extends Model
{
    protected $table = 'user1';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'membership_date',
    ];
}
