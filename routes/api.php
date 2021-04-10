<?php

Route::post('/feedback', 'ApiController@feedback')->name('api.feedback');
Route::post('/login', 'ApiController@login')->name('api.login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/log', 'ApiController@log')->name('exceptions.log');

    // This is still used by the Laravel Nova tool
    Route::get('/recent-exceptions', 'ExceptionController@recentExceptions')->name('exceptions.recent');
    Route::get('/exception/{exception}', 'ExceptionController@show')->name('exceptions.show');
    Route::post('/exception/mark/{exception}', 'ExceptionController@markAs')->name('exceptions.mark');

    Route::get('projects', 'ProjectController@list');
    Route::get('projects/{project}', 'ProjectController@show');
    Route::get('projects/{project}/exceptions', 'ProjectController@exceptions');
    Route::get('projects/{project}/exceptions/{exception}', 'ProjectController@exception');
    Route::post('projects', 'ProjectController@store');
});
