<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CategoryController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/categories', [CategoryController::class, 'showCategory'])->name('categories.index');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update'); // modifie une catégorie
    Route::get('/show/{id}', [CategoryController::class, 'show'])->name('categories.show'); // affiche une catégorie
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create'); // affiche le formulaire de création
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store'); // enregistre une catégorie
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // affiche le formulaire d'édition
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy'); // supprime une catégorie
    Route::delete('/categories/destroysource', [CategoryController::class, 'destroysource'])->name('categories.destroysource'); // supprime une source
    Route::delete('/categories/destroysourcebyId/{id}', [CategoryController::class, 'destroysourcebyId'])->name('categories.destroysourcebyId'); // supprime une source
    Route::post('/categories/{id}/storeflux', [CategoryController::class, 'storeFlux'])->name('categories.storeflux'); // enregistre un flux
    Route::get('/flux',[CategoryController::class, 'showFlux'])->name('categories.flux');
});

require __DIR__.'/auth.php';
