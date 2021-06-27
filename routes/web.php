<?php

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

Route::get('/', function () {
    return view('top');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', [App\Http\Controllers\App\AssetController::class, 'showAssetList'])->name('list');
Route::get('/asset/register', [App\Http\Controllers\App\AssetController::class, 'showAssetRegisterForm'])->name('assetRegister');
Route::post('/asset/register/store', [App\Http\Controllers\App\AssetController::class, 'assetRegister']);
Route::get('/asset/{asset_id}', [App\Http\Controllers\App\AssetController::class, 'showAssetDetail'])->name('assetDetail');
Route::get('/asset/{asset_id}/edit', [App\Http\Controllers\App\AssetController::class, 'showAssetEdit'])->name('assetEdit');
Route::post('/asset/{asset_id}/edit/store', [App\Http\Controllers\App\AssetController::class, 'assetEdit']);




