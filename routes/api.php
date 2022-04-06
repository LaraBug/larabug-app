<?php

use App\Http\Controllers\Api\ApiController;

Route::post('/feedback', [ApiController::class, 'feedback'])->name('api.feedback');

Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('api.login');
Route::post('register-fcm-token', [\App\Http\Controllers\Api\UserController::class, 'registerFcmToken'])->name('api.register-fcm-token');
Route::post('projects/channels/telegram/'.config('services.telegram.token').'/webhook', [TelegramController::class, 'receiveFromWebhook']);

Route::middleware('auth:api')->group(function () {
    Route::post('/log', [ApiController::class, 'log'])->name('exceptions.log');

    Route::get('user', [\App\Http\Controllers\Api\UserController::class, 'show'])->name('api.user.show');
    Route::get('sponsors', [\App\Http\Controllers\Api\SponsorController::class, 'index'])->name('api.sponsors');

    Route::group(['prefix' => 'exceptions', 'as' => 'api.exceptions'], function () {
        Route::get('/', [\App\Http\Controllers\Api\ExceptionController::class, 'index'])->name('index');
        Route::get('{exception}', [\App\Http\Controllers\Api\ExceptionController::class, 'show'])->name('show');
        Route::post('{exception}/read', [\App\Http\Controllers\Api\ExceptionController::class, 'read'])->name('read');
        Route::post('{exception}/toggle-public', [\App\Http\Controllers\Api\ExceptionController::class, 'togglePublic'])->name('toggle-public');
        Route::delete('{exception}', [\App\Http\Controllers\Api\ExceptionController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'projects', 'as' => 'api.projects.'], function () {
        Route::get('/', [\App\Http\Controllers\Api\ProjectController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Api\ProjectController::class, 'store'])->name('store');
        Route::get('{project}', [\App\Http\Controllers\Api\ProjectController::class, 'show'])->name('show');
        Route::get('{project}/exceptions', [\App\Http\Controllers\Api\ProjectController::class, 'exceptions'])->name('exceptions');
        Route::get('{project}/exceptions/{exception}', [\App\Http\Controllers\Api\ProjectController::class, 'exception'])->name('exception');
    });
});
