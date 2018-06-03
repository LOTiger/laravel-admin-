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


Route::get('/', 'IndexController@index')->name('index');
Route::get('/article/{id}', 'IndexController@article')->where(['id' => '[0-9]+'])->name('article');
Route::get('/articleenroll/{id}', 'IndexController@articleEnroll')->name('articleEnroll')->where(['id' => '[0-9]+']);
Route::any('/contact', 'IndexController@contact')->name('contact');
Route::post('/comment', 'IndexController@comment')->name('comment');
