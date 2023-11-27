<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GameController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/game', [GameController::class, 'index'])->name('game');
    // 다른 게임과 관련된 라우트를 추가할 수 있습니다.
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
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    // 다른 커뮤니티과 관련된 라우트를 추가할 수 있습니다.
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
