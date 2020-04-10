<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Category;
use App\Models\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(SubCategory::class, function (Faker $faker) {
    $category = Category::all()->random();
    return [
        'name' => $faker->firstNameMale,
        'category_id' => $category->id,
        'meta' => "[]",
    ];
});
