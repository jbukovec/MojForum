<?php

use Faker\Generator as Faker;

$factory->define(App\Komentar::class, function (Faker $faker) {
    $teme_count = App\Tema::all()->count();
    return [
        'tekst_komentara' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'tema_id' => rand(1, $teme_count)
    ];
});
