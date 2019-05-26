<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ログイン、ログアウト
Route::get('/login', 'Auth\LoginController@loginConfirm');
Route::get('/logout', 'Auth\LoginController@logout');

//Facebookログイン
Route::get('/auth/login/facebook', 'Auth\SocialController@getFacebookAuth');
Route::get('/auth/login/callback/facebook', 'Auth\SocialController@getFacebookAuthCallback');
//Githubログイン
Route::get('/auth/login/github', 'Auth\SocialController@getGithubAuth');
Route::get('/auth/login/callback/github', 'Auth\SocialController@getGithubAuthCallback');

Route::post('/user', 'User\UserController@updateUser');

Route::get('/', 'HomeController@index');

Route::get('/post', 'PostController@index');
Route::post('/upload', 'PostController@upload');
Route::delete('/post/destroy/{id}', 'PostController@destroy');

Route::post('/like/store/post/{id}', 'LikeController@store');
Route::post('/like/destroy/post/{id}', 'LikeController@destroy');

Route::get('/likeuser/index/post/{id}', 'LikeUserController@index');

Route::get('/profile/user/{id}', 'ProfileController@index');

//テスト用
//Route::get('/test', 'TestController@index');
