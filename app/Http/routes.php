<?php

/**
 * Home Page
 */

Route::get('/', 'PagesController@home');
Route::get('/notices/confirm/confirm', 'NoticesController@confirm');
Route::patch('/notices/{id}', 'NoticesController@removeNotice');
Route::resource('notices', 'NoticesController');
Route::auth();
