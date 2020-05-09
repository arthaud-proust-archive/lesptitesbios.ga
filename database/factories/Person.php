<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;

$factory->define(Person::class, function () {
    return [
        'name' => 'Baudelaire',
        'slug' => 'baudelaire',
        'state' => 'writing',
        'date' => '1821 - 1867',
        'bio' => Str::random(10),
        'notes' => Str::random(10)
    ];
});
