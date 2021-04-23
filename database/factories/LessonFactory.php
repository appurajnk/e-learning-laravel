<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker, $params) {
    $type = $faker->randomElement(['video', 'youtube', 'article']);
    //$max = Lesson::max('id');
    return [
        'course_id' => $params['course_id'],
        'uuid' => (string)\Str::uuid(),
        'lesson_type' => 'lecture',
        'title' => \Str::title($faker->unique()->sentence),
        'description' => $faker->paragraphs(1, true),
        'content_type' => $type,
        'duration' => $faker->randomFloat($nbMaxDecimals=2, $min= 0.5, $max = 10),
        'article_body' => $type == 'article' ? '<p>' . $faker->paragraph(rand(3,10), true) . '</p><p>' . $faker->paragraph(rand(2,10), true) . '</p>' : null,
        'preview' => $type == 'article' && $type !== null ? rand(0,1) : 0,
        'sortOrder' => $params['sortOrder']

    ];
});
