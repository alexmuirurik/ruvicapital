<?php

use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
use App\Models\Contract;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified', 'validate_contract'])->name('dashboard');
Route::get('/ajaxchart', [HomeController::class, 'ajaxChart'])->middleware(['auth', 'verified', 'validate_contract'])->name('ajaxchart');

Route::middleware(['auth', 'validate_contract'])->group(function () {
    Route::resources([
        'earnings'  =>  EarningController::class,
        'deposits'  =>  DepositController::class,
        'withdraw'  =>  WithdrawController::class,
        'messages'  =>  MessageController::class,
        'contract'  =>  ContractController::class,
        'settings'  =>  SettingController::class,
    ],  ['except' => ['create', 'show', 'edit', 'destroy']]);
    Route::resource('user', UserController::class)->middleware('auth', 'validate_contract');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';

Route::fallback(function () { return view('pages.notfound'); });
