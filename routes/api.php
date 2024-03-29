<?php

use App\Http\Controllers\api\v1\AreaController;
use App\Http\Controllers\api\v1\KcPlantaController;
use App\Http\Controllers\api\v1\DataPodasController;
use App\Http\Controllers\api\v1\MedidasController;
use App\Http\Controllers\api\v1\PropriedadeController;
use App\Http\Controllers\api\v1\SetorController;
use App\Http\Controllers\api\v1\EstacaoController;
use App\Http\Controllers\api\v1\Eto;
use Illuminate\Support\Facades\Route;


Route::controller(MedidasController::class)->name('medidas.')->prefix('medidas')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(PropriedadeController::class)->name('propriedade.')->prefix('propriedade')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(EstacaoController::class)->name('estacao.')->prefix('estacao')->group(function() {
    Route::get('/et0', 'et0')->name('et0');
    Route::get('/dados-meteriologicos', 'dadosMeteriologicos')->name('dados-meteriologicos');
    Route::get('/historioco-temperatura', 'historiocoTemperatura')->name('historioco-temperatura');
});

Route::controller(Eto::class)->name('eto.')->prefix('eto')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/filtro/{id}', 'filtroEto')->name('filtro');
});

Route::controller(KcPlantaController::class)->name('kcplanta.')->prefix('kcplanta')->group(function() {
    Route::get('/', 'index')->name('index'); 
});

Route::controller(AreaController::class)->name('area.')->prefix('area')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(SetorController::class)->name('setor.')->prefix('setor')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/consumo-por-setor', 'consumoPorSetor')->name('consumo-por-setor');
    Route::get('/consumo-da-cultura', 'consumoDaCultura')->name('consumo-da-cultura');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(DataPodasController::class)->name('datapoda.')->prefix('datapoda')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});




