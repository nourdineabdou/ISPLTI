<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesseurController;

// route groupe professeur
Route::group(['middleware' => ['auth'], 'prefix' => 'professeurs'], function () {
    Route::get('/', [ProfesseurController::class, 'index'])->name('professeurs.index');
    Route::get('/create', [ProfesseurController::class, 'create'])->name('professeurs.create');
    Route::post('/', [ProfesseurController::class, 'store'])->name('professeurs.store');
    Route::get('/{id}', [ProfesseurController::class, 'show'])->name('professeurs.show');
    Route::get('/{id}/edit', [ProfesseurController::class, 'edit'])->name('professeurs.edit');
    Route::put('/{id}', [ProfesseurController::class, 'update'])->name('professeurs.update');
    Route::delete('/{id}', [ProfesseurController::class, 'destroy'])->name('professeurs.destroy');
});
