<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'parcial2','middleware' => 'cross.angular'], function () {
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
    Route::resource('comentarios', 'ComentarioController');
    Route::resource('calificacions', 'CalificacionController');
    Route::get('calificacions/{user_id}/{post_id}', 'CalificacionController@Show');
});


