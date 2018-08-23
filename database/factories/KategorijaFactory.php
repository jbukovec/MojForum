<?php

use Faker\Generator as Faker;

$factory->define(App\Kategorija::class, function (Faker $faker) {
    return [
        'naziv_kategorije' => $faker->text($maxNbChars = 25),
        'url_naziv' => $faker->slug
        //
    ];
});
