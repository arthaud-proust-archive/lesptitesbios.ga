<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    protected $table = 'persons';

    protected $fillable = [
        'id', 'slug', 'state', 'name', 'img', 'date', 'bio', 'notes', 'editor'
    ];

    public $timestamps = true;
}
