<?php

Route::permanentRedirect('terms', 'terms-of-service');
Route::permanentRedirect('privacy', 'privacy-policy');
Route::permanentRedirect('dashboard', 'panel');
Route::permanentRedirect('what-is-larabug', 'features');

Route::redirect('discord', 'https://discord.gg/AWrdVpc');

Route::get('/', 'PageController@home')->name('home');

Route::group([], function () {

//    Route::get('requirements', 'PageController@requirements')->name('page.requirements');
    Route::get('features', 'PageController@features')->name('features');
    Route::get('pricing', 'PageController@pricing')->name('pricing');
    Route::get('branding', 'PageController@branding')->name('branding');
    Route::get('larabug-is-free', 'PageController@larabugIsFree')->name('larabug-is-free');
//    Route::get('what-is-larabug', 'PageController@explanation')->name('page.explanation');

    Route::get('terms-of-service', 'PageController@terms')->name('terms');
    Route::get('privacy-policy', 'PageController@policy')->name('privacy');

//    Route::get('contact', 'ContactController@contact')->name('contact');
//    Route::post('contact', 'ContactController@send')->name('contact.send');

    Route::group(['prefix' => 'docs', 'as' => 'docs.'], function () {
        Route::get('/', 'DocumentationController@index')->name('index');
        Route::get('{category}/{documentation}', 'DocumentationController@show')->name('show');
    });
});

Route::get('exception/{hash}', 'PageController@exception')->name('public.exception');

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('socialite.login');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('socialite.callback');

Route::get('scripts/feedback', 'FeedbackController@script')->name('feedback.script');

Route::group(['middleware' => 'auth', 'prefix' => 'panel', 'as' => 'panel.'], function () {
    Route::get('documentation', 'DocumentationController@index')->name('documentation');
    Route::get('documentation/{documentation}', 'DocumentationController@show')->name('documentation.show');

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('introduction', 'HomeController@introduction')->name('introduction');

    Route::resource('projects', 'ProjectController');
    Route::get('projects/{id}/installation', 'ProjectController@installation')->name('projects.installation');
    Route::get('projects/{id}/feedback-installation', 'ProjectController@feedbackInstallation')->name('projects.feedback-installation');
    Route::post('projects/{id}/test-webhook', 'ProjectController@testWebhook')->name('projects.test.webhook');
    Route::post('projects/{id}/remove-image', 'ProjectController@removeImage')->name('projects.remove.image');

    Route::resource('groups', 'GroupController');

    Route::delete('projects/{id}/exceptions/delete-all', 'ExceptionController@deleteAll')->name('exceptions.delete-all');
    Route::resource('projects/{id}/exceptions', 'ExceptionController');
    Route::post('projects/{id}/exceptions/{exception}/fixed', 'ExceptionController@fixed')->name('exceptions.fixed');
    Route::post('projects/{id}/exceptions/{exception}/toggle-public', 'ExceptionController@togglePublic')->name('exceptions.toggle-public');
    Route::post('projects/{id}/exceptions/mark-as', 'ExceptionController@markAs')->name('exceptions.mark-as');
    Route::post('projects/{id}/exceptions/mark-all-fixed', 'ExceptionController@markAllAsFixed')->name('exceptions.mark-all-fixed');
    Route::post('projects/{id}/exceptions/mark-all-read', 'ExceptionController@markAllAsRead')->name('exceptions.mark-all-read');

    Route::get('feedback', 'FeedbackController@index')
        ->middleware('has.feature:feedback')
        ->name('feedback.index');

    // Profile routes
    Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile.show');
        Route::patch('/', 'ProfileController@update')->name('profile.update');
        Route::patch('settings', 'ProfileController@settings')->name('profile.settings');
    });
});
