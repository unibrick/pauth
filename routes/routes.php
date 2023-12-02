<?php


use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Unibrick\PAuth\Actions\SocialUserLogin;
use Unibrick\PAuth\Http\Controllers\Auth\AuthenticatedSessionController;
use Unibrick\PAuth\Http\Controllers\Auth\RegisteredUserController;

Route::middleware(['web'])->group(function () {
    Route::controller(RegisteredUserController::class)->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');
    });

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store');
        Route::get('logout', 'destroy')->name('logout');
    });
});
//----------------------------------------------------------------------------------------------------------------------
Route::middleware(['web'])->group(function () {
    Route::get('/oauth/redirect/yandex', function () {
        return Socialite::driver('yandex')->redirect();
    })->name('yandex');

    Route::get('/oauth/callback/yandex', function (SocialUserLogin $socialUserLogin) {
        $socialUserLogin->handle(Socialite::driver('yandex')->user());
        return redirect()->intended();
    });

//----------------------------------------------------------------------------------------------------------------------
    Route::get('/oauth/redirect/vkontakte', function () {
        return Socialite::driver('vkontakte')->redirect();
    })->name('vkontakte');

    Route::get('/oauth/callback/vkontakte', function (SocialUserLogin $socialUserLogin) {
        $socialUserLogin->handle(Socialite::driver('vkontakte')->user());
        return redirect()->intended();
    });

//----------------------------------------------------------------------------------------------------------------------
    Route::get('/oauth/redirect/mailru', function () {
        return Socialite::driver('mailru')->redirect();
    })->name('mailru');

    Route::get('/oauth/callback/mailru', function (SocialUserLogin $socialUserLogin) {
        $socialUserLogin->handle(Socialite::driver('mailru')->user());
        return redirect()->intended();
    });


//----------------------------------------------------------------------------------------------------------------------
    Route::get('/oauth/redirect/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('google');

    Route::get('/oauth/callback/google', function (SocialUserLogin $socialUserLogin) {
        $socialUserLogin->handle(Socialite::driver('google')->user());
        return redirect()->intended();
    });

});
//----------------------------------------------------------------------------------------------------------------------
