<?php

use App\Http\Controllers\Admin\AdminSettingPanelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Models\Admin;
use App\Models\AdminPannelSetting;
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

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/setting/index', [AdminSettingPanelController::class, 'index'])->name('admin.adminPanelSetting.index');
    Route::get('/setting/edit', [AdminSettingPanelController::class, 'edit'])->name('admin.adminPanelSetting.edit');
    Route::post('/setting/update', [AdminSettingPanelController::class, 'update'])->name('admin.adminPanelSetting.update');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});