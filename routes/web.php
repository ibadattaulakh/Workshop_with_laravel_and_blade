<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route:: get ('/', function (){
    return view ('welcome');
});

// Development-only helper routes
Route::get('/login-as-dev', function () {
    Auth::loginUsingId(5);
    return redirect('/home');
})->name('login');

Route::get('/dev/login', function () {
    $user = User::inRandomOrder()->first();

    Auth::login($user);
    session()->regenerate();

    return redirect()->route('profiles.show', $user->profile);
})->name('dev.login');

Route::get('/dev/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/feed');
})->name('dev.logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [PostController::class, 'index'])
        ->name('posts.index');
    
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');
    
    Route::post('/profiles/{profile}/posts/{post}/reply', [PostController::class, 'reply'])
        ->name('posts.reply');
    
    Route::post('/profiles/{profile}/posts/{post}/repost', [PostController::class, 'repost'])
        ->name('posts.repost');
    
    Route::post('/profiles/{profile}/posts/{post}/quote', [PostController::class, 'quote'])
        ->name('posts.quote');
    
    Route::post('/profiles/{profile}/posts/{post}/like', [PostController::class, 'like'])
        ->name('posts.like');
    
    Route::post('/profiles/{profile}/posts/{post}/unlike', [PostController::class, 'unlike'])
        ->name('posts.unlike');
    
    Route::post('/profiles/{profile}/follow', [ProfileController::class, 'follow'])
        ->name('profiles.follow');
    
    Route::post('/profiles/{profile}/unfollow', [ProfileController::class, 'unfollow'])
        ->name('profiles.unfollow');
    
    Route::post('/profiles/{profile}/posts/{post}/destroy', [PostController::class, 'destroy'])
        ->name('posts.destroy');
});

Route::get('/profiles/{profile}/replies', [ProfileController::class, 'replies'])
    ->name('profiles.replies');

Route::get('/{profile:handle}/status/{post}', [PostController::class, 'show'])
    ->scopeBindings()
    ->name('posts.show');

Route::get('/{profile:handle}', [ProfileController::class, 'show'])->name('profiles.show');