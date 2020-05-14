<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'action', 'user', 'content'
    ];

    public $timestamps = true;
}
