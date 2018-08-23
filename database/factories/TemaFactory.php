<?php

use Faker\Generator as Faker;

$factory->define(App\Tema::class, function (Faker $faker) {
    $kategorija_count = App\Kategorija::all()->count();
    return [
        'naslov_teme' => $faker->text($maxNbChars = 190),
        'opis_teme' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'kategorija_id' => rand(1, $kategorija_count)
    ];
});
