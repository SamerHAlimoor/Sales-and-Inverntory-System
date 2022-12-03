<?php

use App\Http\Controllers\Admin\AdminSettingPanelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryItemCartContorller;
use App\Http\Controllers\Admin\InventoryItemCartController;
use App\Http\Controllers\Admin\InventoryItemCategoryController;
use App\Http\Controllers\Admin\InventoryUomController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SalesMaterialTypeController;
use App\Http\Controllers\Admin\StoresController;
use App\Http\Controllers\Admin\TreasuriesController;
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

const PAGINATION_COUNT = 10;


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/setting/index', [AdminSettingPanelController::class, 'index'])->name('admin.adminPanelSetting.index');
    Route::get('/setting/edit', [AdminSettingPanelController::class, 'edit'])->name('admin.adminPanelSetting.edit');
    Route::post('/setting/update', [AdminSettingPanelController::class, 'update'])->name('admin.adminPanelSetting.update');
    /*         start treasuries                */

    Route::get('/treasuries/index', [TreasuriesController::class, 'index'])->name('admin.treasuries.index');
    Route::get('/treasuries/create', [TreasuriesController::class, 'create'])->name('admin.treasuries.create');
    Route::post('/treasuries/store', [TreasuriesController::class, 'store'])->name('admin.treasuries.store');
    Route::get('/treasuries/edit/{id}', [TreasuriesController::class, 'edit'])->name('admin.treasuries.edit');
    Route::post('/treasuries/update/{id}', [TreasuriesController::class, 'update'])->name('admin.treasuries.update');
    Route::post('/treasuries/ajax_search', [TreasuriesController::class, 'ajax_search'])->name('admin.treasuries.ajax_search');
    Route::get('/treasuries/details/{id}', [TreasuriesController::class, 'details'])->name('admin.treasuries.details');
    Route::get('/treasuries/add_treasuries_delivery/{id}', [TreasuriesController::class, 'Add_treasuries_delivery'])->name('admin.treasuries.Add_treasuries_delivery');
    Route::post('/treasuries/store_treasuries_delivery/{id}', [TreasuriesController::class, 'store_treasuries_delivery'])->name('admin.treasuries.store_treasuries_delivery');
    Route::get('/treasuries/delete_treasuries_delivery/{id}', [TreasuriesController::class, 'delete_treasuries_delivery'])->name('admin.treasuries.delete_treasuries_delivery');
    /*           end treasuries                */
    /*         start sales_material_types                */
    Route::get('/sales-material-types/index', [SalesMaterialTypeController::class, 'index'])->name('admin.sales_material_types.index');
    Route::get('/sales-material-types/create', [SalesMaterialTypeController::class, 'create'])->name('admin.sales_material_types.create');
    Route::post('/sales-material-types/store', [SalesMaterialTypeController::class, 'store'])->name('admin.sales_material_types.store');
    Route::get('/sales-material-types/edit/{id}', [SalesMaterialTypeController::class, 'edit'])->name('admin.sales_material_types.edit');
    Route::post('/sales-material-types/update/{id}', [SalesMaterialTypeController::class, 'update'])->name('admin.sales_material_types.update');
    Route::get('/sales-material-types/delete/{id}', [SalesMaterialTypeController::class, 'delete'])->name('admin.sales_material_types.delete');
    /*           end sales_material_types                */

    /*         start stores                */
    Route::get('/stores/index', [StoresController::class, 'index'])->name('admin.stores.index');
    Route::get('/stores/create', [StoresController::class, 'create'])->name('admin.stores.create');
    Route::post('/stores/store', [StoresController::class, 'store'])->name('admin.stores.store');
    Route::get('/stores/edit/{id}', [StoresController::class, 'edit'])->name('admin.stores.edit');
    Route::post('/stores/update/{id}', [StoresController::class, 'update'])->name('admin.stores.update');
    Route::get('/stores/delete/{id}', [StoresController::class, 'delete'])->name('admin.stores.delete');
    /*           end stores                */
    /*         start  Uom Units               */
    Route::get('/uoms/index', [InventoryUomController::class, 'index'])->name('admin.uoms.index');
    Route::get('/uoms/create', [InventoryUomController::class, 'create'])->name('admin.uoms.create');
    Route::post('/uoms/store', [InventoryUomController::class, 'store'])->name('admin.uoms.store');
    Route::get('/uoms/edit/{id}', [InventoryUomController::class, 'edit'])->name('admin.uoms.edit');
    Route::post('/uoms/update/{id}', [InventoryUomController::class, 'update'])->name('admin.uoms.update');
    Route::get('/uoms/delete/{id}', [InventoryUomController::class, 'delete'])->name('admin.uoms.delete');
    Route::post('/uoms/ajax_search', [InventoryUomController::class, 'ajax_search'])->name('admin.uoms.ajax_search');
    /*           end Units                */

    /*         start  inv item card categories */
    Route::resource('/inv-item-card-categories', InventoryItemCategoryController::class);
    Route::get('/inv-item-card-categories/delete/{id}', [InventoryItemCategoryController::class, 'delete'])->name('inv-item-card-categories.delete');

    /*         End inv item card categories

    /*         start  inv item card  */
    Route::resource('/inv-item-card', InventoryItemCartController::class)->except(['update']);
    Route::post('/inv-item-card/update/{id}', [InventoryItemCartController::class, 'update'])->name('inv-item-card.update');
    Route::get('/inv-item-card/delete/{id}', [InventoryItemCartController::class, 'delete'])->name('inv-item-card.delete');
    Route::post('/inv-item-card/ajax_search', [InventoryItemCartController::class, 'ajax_search'])->name('admin.inv-item-card.ajax_search');

    /*         End inv item card 
*/
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});