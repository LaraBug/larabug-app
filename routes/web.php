<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ExceptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\TelegramController;

Route::permanentRedirect('terms', 'terms-of-service');
Route::permanentRedirect('privacy', 'privacy-policy');
Route::permanentRedirect('dashboard', 'panel');
Route::permanentRedirect('what-is-larabug', 'features');

Route::redirect('discord', 'https://discord.gg/AWrdVpc');

Route::get('/', [PageController::class, 'home'])->name('home')->middleware('minimal');

Route::group([
    'middleware' => [
        'minimal',
    ],
], function () {
    Route::get('features', [PageController::class, 'features'])->name('features');
    Route::get('pricing', [PageController::class, 'pricing'])->name('pricing');
    Route::get('branding', [PageController::class, 'branding'])->name('branding');
    Route::get('larabug-is-free', [PageController::class, 'larabugIsFree'])->name('larabug-is-free');

    Route::get('terms-of-service', [PageController::class, 'terms'])->name('terms');
    Route::get('privacy-policy', [PageController::class, 'policy'])->name('privacy');

    Route::get('docs', [DocumentationController::class, 'index'])->name('docs.index');
    Route::get('docs/{category}/{item}', [DocumentationController::class, 'show'])->name('docs.show');
});

Route::get('exception/{exception:publish_hash}', [PageController::class, 'exception'])->name('public.exception');

Auth::routes([
    'register' => config('auth.register_enabled'),
    'verify' => config('auth.verify_enabled')
]);

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('socialite.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('socialite.callback');

Route::get('scripts/feedback', [FeedbackController::class, 'script'])->name('feedback.script');

Route::post('projects/channels/telegram/'.config('services.telegram.token').'/webhook', [TelegramController::class, 'receiveFromWebhook']);

Route::middleware('auth')->prefix('panel')->name('panel.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('introduction', [HomeController::class, 'introduction'])->name('introduction');

    Route::group(['middleware' => config('auth.verify_enabled') ? 'verified' : []], function () {
        Route::resource('projects', ProjectController::class);
        Route::get('projects/{id}/installation', [ProjectController::class, 'installation'])->name('projects.installation');
        Route::get('projects/{id}/feedback-installation', [ProjectController::class, 'feedbackInstallation'])->name('projects.feedback-installation');
        Route::post('projects/{id}/test-webhook', [ProjectController::class, 'testWebhook'])->name('projects.test.webhook');
        Route::post('projects/{id}/remove-image', [ProjectController::class, 'removeImage'])->name('projects.remove.image');
        Route::post('projects/{id}/refresh-token', [ProjectController::class, 'refreshToken'])->name('projects.refresh-token');

        Route::resource('groups', GroupController::class);

        Route::delete('projects/{id}/exceptions/delete-all', [ExceptionController::class, 'deleteAll'])->name('exceptions.delete-all');
        Route::post('projects/{id}/exceptions/delete-selected', [ExceptionController::class, 'deleteSelected'])->name('exceptions.delete-selected');
        Route::post('projects/{id}/exceptions/delete-fixed', [ExceptionController::class, 'deleteFixed'])->name('exceptions.delete-fixed');
        Route::resource('projects/{id}/exceptions', ExceptionController::class);
        Route::post('projects/{id}/exceptions/{exception}/fixed', [ExceptionController::class, 'fixed'])->name('exceptions.fixed');
        Route::post('projects/{id}/exceptions/{exception}/snooze', [ExceptionController::class, 'snooze'])->name('exceptions.snooze');
        Route::post('projects/{id}/exceptions/{exception}/unsnooze', [ExceptionController::class, 'unSnooze'])->name('exceptions.un-snooze');
        Route::post('projects/{id}/exceptions/{exception}/toggle-public', [ExceptionController::class, 'togglePublic'])->name('exceptions.toggle-public');
        Route::post('projects/{id}/exceptions/mark-as', [ExceptionController::class, 'markAs'])->name('exceptions.mark-as');
        Route::post('projects/{id}/exceptions/mark-all-fixed', [ExceptionController::class, 'markAllAsFixed'])->name('exceptions.mark-all-fixed');
        Route::post('projects/{id}/exceptions/mark-all-read', [ExceptionController::class, 'markAllAsRead'])->name('exceptions.mark-all-read');

        Route::get('projects/channels/telegram/generate-token', [TelegramController::class, 'generateToken'])->name('projects.channels.telegram.generate-token');

        Route::get('feedback', [FeedbackController::class, 'index'])
            ->middleware('has.feature:feedback')
            ->name('feedback.index');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
            Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
            Route::patch('password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
            Route::patch('settings', [ProfileController::class, 'settings'])->name('profile.settings');

            Route::group(['prefix' => 'fcm-tokens'], function () {
                Route::get('/', [\App\Http\Controllers\Profile\FcmController::class, 'index'])->name('profile.fcm-tokens.index');
                Route::delete('{id}', [\App\Http\Controllers\Profile\FcmController::class, 'destroy'])->name('profile.fcm-tokens.destroy');
            });
        });
    });
});
