<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker, $user_id) {
    $title = \Str::title($faker->unique()->sentence);
    $childrenCategories = \App\Models\Category::whereNotNull('parent_id')->pluck('id');
    return [
        'user_id' => $user_id, // make this a relationship
        'category_id' => $faker->randomElement($childrenCategories),
        'image' => $faker->image('public/uploads/images/course/thumbnails',250,140, null, false),
        'uuid' => (string)\Str::uuid(),
        'title' => $title,
        'subtitle' => \Str::title($faker->unique()->sentence),
        'slug' => \Str::slug($title),
        'description' => $faker->paragraphs(rand(2,4), true), // true means return as a string and not array
        'language' => $faker->randomElement(['English', 'French', 'Spanish']),
        'level' => $faker->randomElement(['All', 'Beginner', 'Intermediate', 'Advanced']),
        'price' => $faker->numberBetween(0, 200),
        'published' => true,
        'approved' => true
    ];
});


