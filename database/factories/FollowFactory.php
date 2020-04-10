<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Follower;
use App\Models\User;
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

$factory->define(Follower::class, function (Faker $faker) {
    $user = User::all()->random();
    $friend = User::all()->where('id', '!=', $user->id)->random();
    return [
       'user_id' => $user->id,
       'friend_id' => $friend->id 
    ];
});
