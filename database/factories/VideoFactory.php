<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker, $params) {
    //$encoded = rand(0,1);
    //$encoded = $lesson_type == 'video';
    $youtube_link = $faker->randomElement([
        'https://www.youtube.com/watch?v=hdI2bqOjy3c', 
        'https://www.youtube.com/watch?v=Fdf5aTYRW0E', 
        'https://www.youtube.com/watch?v=sBws8MSXN7A'
    ]);

    return [
        'uuid' => (string)\Str::uuid(),
        'is_processed' => true,
        'processing_succeeded' => true,
        'encoded' => $params['encoded'],
        'disk' => $params['encoded'] == 1 ? 'local' : 'youtube',
        'streamable_sm' => $params['encoded'] == 1 ? 'sample_360.mp4' : null,
        'streamable_lg' => $params['encoded'] == 1 ? 'sample_720.mp4' : null,
        'converted_for_streaming_at' => $params['encoded'] == 1 ? \Carbon\Carbon::now() : null,
        'original_filename' =>$params['encoded'] == 1 ? 'sample_360.mp4' : null,
        'youtube_link' => $params['encoded'] == 1 ? null : $youtube_link
    ];
});
