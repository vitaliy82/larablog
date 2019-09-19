<?php

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('post','PostsController');
Route::resource('comment','CommentController');
Route::get('post/{id}/delete', ['as' => 'post.delete', 'uses' => 'PostsController@destroy']);
Route::get('/like/{id}', 'LikeController@create')->name('like.create');
Route::get('/unlike/{id}', 'LikeController@delete')->name('like.delete');
