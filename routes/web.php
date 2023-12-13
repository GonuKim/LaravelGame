<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/game', [GameController::class, 'index'])->name('game.index');
    Route::post('/game', [GameController::class, 'store'])->name('game.store');
    Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
    // 다른 랭킹과 관련된 라우트를 추가할 수 있습니다.
});

Route::middleware(['auth'])->group(function () {
    Route::get('/event', [EventController::class, 'index'])->name('event');
    // 다른 이벤트과 관련된 라우트를 추가할 수 있습니다.
});

Route::middleware(['auth'])->group(function () {
    Route::get('/community', [PostController::class, 'index'])->name('community.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('community.create');
    Route::post('/community', [PostController::class, 'store'])->name('community.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('community.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('community.delete');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('community.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('community.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('/posts/{post}/comments/{id}', [CommentController::class, 'destroy']);
});

require __DIR__.'/auth.php';
