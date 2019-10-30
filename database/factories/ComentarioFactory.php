<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comentario;
use Faker\Generator as Faker;

$factory->define(Comentario::class, function (Faker $faker){
    $users = App\User::pluck('id')->toArray();
    $posts = App\Post::pluck('id')->toArray();
    return [
        'contenido' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'user_id' =>$faker->randomElement($users),
        'post_id' =>$faker->randomElement($posts),
    ];
});
