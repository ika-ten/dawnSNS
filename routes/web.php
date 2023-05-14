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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

Route::get('/', function () {
  return view('auth/login');  
});


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/top','PostsController@index');

//Route::get('/profile','UsersController@profile');
//Route::get('/profile','UsersController@index');
//Route::get('/profile/{id}','UsersController@index');

//Route::get('/search','UsersController@index');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('posts/store','PostsController@store');
Route::resource('/posts', 'PostsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
//参考:https://qiita.com/namizatork/items/c9ed67f98fc3e5ce67c7


Route::get('/search', 'UsersController@search')->name('search');

Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');


//Route::get('/profile/{id}','UsersController@updateProfile');

Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

Route::get('post/{id}/update-form', 'PostsController@updateForm');
//Route::get('top', 'PostsController@updateForm');
Route::post('post/update', 'PostsController@update');
Route::get('post/{id}/delete', 'PostsController@delete');

//Route::get('/profile' , 'PostsController@profile');
//Route::post('/profile' , 'PostsController@profile');

Route::get('/profile/{id}' , 'UsersController@index');
Route::post('/profile/{id}' , 'UsersController@index');
Route::post('user/update' , 'UsersController@update');


Route::get('/test','PostsController@test');
