<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artwork;

$factory->define(Artwork::class, function () {
    return [
        'name' => 'Une charogne',
        'slug' => 'une-charogne',
        'state' => 'writing',
        'person' => 'Baudelaire',
        'date' => '1857',
        'content' => Str::random(10),
        'text' => Str::random(10)
    ];
});
