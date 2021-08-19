<?php

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

// Route::prefix('controle/banners')->group(function() {
//     Route::get('/', 'BrediBannerController@index');
// });

Route::prefix((!empty(config('bredidashboard.prefix')) ? config('bredidashboard.prefix') : 'controle'))->middleware('auth', Bredi\BrediDashboard\Http\Middleware\ValidaPermissao::class)->as('bredibanner::')->group(
function () {
    Route::get('banners', ['uses' => 'BrediBannerController@index', 'permissao' => 'controle.banner.index'])->name('controle.banner.index');
    Route::get('banner/create', ['uses' => 'BrediBannerController@create', 'permissao' => 'controle.banner.create'])->name('controle.banner.create');
    Route::get('banner/edit/{id}', ['uses' => 'BrediBannerController@edit', 'permissao' => 'controle.banner.edit'])->name('controle.banner.edit');
    Route::post('banner/store', ['uses' => 'BrediBannerController@store', 'permissao' => 'controle.banner.store'])->name('controle.banner.store');
    Route::post('banner/update/{id}', ['uses' => 'BrediBannerController@update', 'permissao' => 'controle.banner.update'])->name('controle.banner.update');
    Route::get('banner/delete/{id}', ['uses' => 'BrediBannerController@destroy', 'permissao' => 'controle.banner.destroy'])->name('controle.banner.destroy');
});