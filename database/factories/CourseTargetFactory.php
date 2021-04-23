<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CourseTarget;
use Faker\Generator as Faker;

$factory->define(CourseTarget::class, function (Faker $faker, $type) {
    $max = CourseTarget::where('type', $type)->max('sortOrder');
    return [
        'uuid' => (string)\Str::uuid(),
        'type' => $type,
        'text' => $faker->sentence(),
        'sortOrder' => $max ? $max : 1
    ];
});
