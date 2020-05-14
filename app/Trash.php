<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    //
    protected $table = 'trash';

    protected $fillable = [
        'id', 'type', 'slug', 'state', 'person', 'name', 'date', 'bio', 'content', 'img', 'text', 'notes', 'editor'
    ];

    public $timestamps = true;
}
