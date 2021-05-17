<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
});

Route::get('/', [FrontController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth','checkRole'])->name('dashboard');

require __DIR__.'/auth.php';

Route::redirect('/admin','/admin/dashboard');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth','is_admin','checkRole'])->name('admin.dashboard');
    Route::resource('question', QuestionController::class, [
        'as' => 'admin'
    ])->middleware(['auth','is_admin','checkRole']);
});
