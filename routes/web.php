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

Route::get('/search', [App\Http\Controllers\App\AssetController::class, 'showAssetSearch']);
Route::post('/list/search', [App\Http\Controllers\App\AssetController::class, 'assetSearch']);
Route::get('/list/{key_word?}', [App\Http\Controllers\App\AssetController::class, 'showAssetList'])->name('list');
Route::get('/asset/register', [App\Http\Controllers\App\AssetController::class, 'showAssetRegisterForm'])->name('assetRegister');
Route::post('/asset/register/store', [App\Http\Controllers\App\AssetController::class, 'assetRegister']);
Route::get('/asset/{asset_id}', [App\Http\Controllers\App\AssetController::class, 'showAssetDetail'])->name('assetDetail');
Route::get('/asset/{asset_id}/edit', [App\Http\Controllers\App\AssetController::class, 'showAssetEdit'])->name('assetEdit');
Route::post('/asset/{asset_id}/edit/store', [App\Http\Controllers\App\AssetController::class, 'assetEdit']);
Route::get('/user', [App\Http\Controllers\App\UserController::class, 'showUserEdit'])->name('userEdit');
Route::post('/user/store', [App\Http\Controllers\App\UserController::class, 'userEdit']);
Route::get('/asset/{asset_id}/delete/store', [App\Http\Controllers\App\AssetController::class, 'assetDelete']);
