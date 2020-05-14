<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artworks extends Model
{
    protected $table = 'artworks';

    protected $fillable = [
        'id', 'slug','state', 'name', 'person', 'date', 'content', 'text', 'notes', 'editor'
    ];

    public $timestamps = true;
}
