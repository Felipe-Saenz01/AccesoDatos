<?php

use App\Http\Controllers\FicheroController;
use App\Models\Fichero;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['ficheros' => Fichero::latest()->paginate()]);
    })->name('dashboard');

    Route::get('/ficheros/create', [FicheroController::class, 'create'])
    ->name('ficheros.create');
    Route::get('/ficheros/{fichero}/{extension}', [FicheroController::class, 'show'])
    ->name('ficheros.show');
    Route::post('/ficheros',[FicheroController::class, 'store'])
    ->name('ficheros.store');
    Route::put('/ficheros/{fichero}',[FicheroController::class, 'update'])
    ->name('ficheros.update');
    Route::delete('/ficheros/{fichero}',[FicheroController::class, 'destroy'])
    ->name('ficheros.destroy');

    Route::put('/ficheros/{fichero}/xml', [FicheroController::class, 'xmlUpdate'])
    ->name('ficheros.xml');
    Route::put('/ficheros/{fichero}/doc', [FicheroController::class, 'docUpdate'])
    ->name('ficheros.doc');
   
});
