<?php

use App\Http\Controllers\api\v1\AreaController;
use App\Http\Controllers\api\v1\KcPlantaController;
use App\Http\Controllers\api\v1\ContatosController;
use App\Http\Controllers\api\v1\DataPodasController;
use App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\MedidasController;
use App\Http\Controllers\api\v1\PerfilController;
use App\Http\Controllers\api\v1\PropriedadeController;
use App\Http\Controllers\api\v1\SetorController;
use App\Http\Controllers\api\v1\StatesController;
use App\Http\Controllers\api\v1\StatisticsMetaController;
use App\Http\Controllers\api\v1\UsuarioController;
use App\Http\Controllers\api\v1\EstacaoController;
use App\Http\Controllers\api\v1\Eto;
use App\Http\Controllers\api\v1\ForgotController;
use App\Http\Controllers\api\v1\GruposPlantasController;
use App\Http\Controllers\api\v1\PlantasController;
use Illuminate\Support\Facades\Route;


// usuario 
Route::prefix('usuario')->name('usuario.')->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/cadastrar', [UsuarioController::class, 'store'])->name('cadastar');
    Route::get('/usuario', [UsuarioController::class, 'usuario'])->middleware('auth:api')->name('usuario');
    Route::put('/{id}', [UsuarioController::class, 'update'])->middleware('auth:api')->name('usuario.update');
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->middleware('auth:api')->name('usuario.destroy'); 
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/forgot', [ForgotController::class, 'forgot'])->name('forgot');
    Route::post('/reset', [ForgotController::class, 'reset'])->name('reset');
});

Route::controller(MedidasController::class)->name('medidas.')->prefix('medidas')->group(function() {
    Route::get('/', 'index')->name('index')->middleware('auth:api');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show')->middleware('auth:api');
    Route::put('/{id}', 'update')->name('update')->middleware('auth:api');
    Route::delete('/{id}', 'destroy')->name('destroy')->middleware('auth:api');
});

Route::controller(PropriedadeController::class)->name('propriedade.')->prefix('propriedade')->group(function() {
    Route::get('/', 'index')->name('index')->middleware('auth:api');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show')->middleware('auth:api');
    Route::put('/{id}', 'update')->name('update')->middleware('auth:api');
    Route::delete('/{id}', 'destroy')->name('destroy')->middleware('auth:api');
});

Route::controller(EstacaoController::class)->name('estacao.')->prefix('estacao')->group(function() {
    Route::get('/et0', 'et0')->name('et0');
    // Route::get('/gdd', 'gdd')->name('gdd');
    Route::post('/gdd', 'gdd')->name('gdd');
});

Route::controller(ContatosController::class)->name('contatos.')->prefix('contatos')->group(function() {
    Route::get('/', 'index')->name('index')->middleware('auth:api');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show')->middleware('auth:api');
    Route::put('/{id}', 'update')->name('update')->middleware('auth:api');
    Route::delete('/{id}', 'destroy')->name('destroy')->middleware('auth:api');
});

Route::controller(Eto::class)->name('eto.')->prefix('eto')->group(function() {
    Route::get('/', 'index')->name('index');
});
//

Route::middleware('auth:api')->group(function () {

    // Nao pode ter metos POST E PUT ↓
    Route::controller(StatesController::class)->name('states.')->prefix('states')->group(function() {
        Route::get('/', 'index')->name('index'); 
        Route::get('/show/{id}', 'show')->name('show'); 
    });
    
    Route::controller(StatisticsMetaController::class)->name('statesmeta.')->prefix('statesmeta')->group(function() {
        Route::get('/', 'index')->name('index'); 
        Route::get('/show/{id}', 'show')->name('show'); 
    });
    // Nao pode ter metos POST E PUT ↑
    Route::controller(PerfilController::class)->name('perfil.')->prefix('perfil')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
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
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::get('kcsetor', [SetorController::class, 'kcsetor'])->name('kcsetor');


    Route::controller(DataPodasController::class)->name('datapoda.')->prefix('datapoda')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });


    Route::controller(GruposPlantasController::class)->name('gruposplantas.')->prefix('gruposplantas')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::controller(PlantasController::class)->name('plantas.')->prefix('plantas')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});







