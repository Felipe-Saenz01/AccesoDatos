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
        return view('dashboard', ['ficheros' => Fichero::paginate()]);
    })->name('dashboard');

    Route::get('/ficheros/create', [FicheroController::class, 'create'])
    ->name('ficheros.create');
    Route::post('/ficheros',[FicheroController::class, 'store'])
    ->name('ficheros.store');

});
