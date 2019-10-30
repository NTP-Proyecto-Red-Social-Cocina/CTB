<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calificacion;
use Faker\Generator as Faker;

$factory->define(Calificacion::class, function (Faker $faker) use ($factory){
    $users = App\User::pluck('id')->toArray();
    $posts = App\Post::pluck('id')->toArray();
    return [
        'nota'=>$faker->numberBetween(0,5),
        'user_id' =>$faker->randomElement($users),
        'post_id' =>$faker->randomElement($posts),
    ];
});
