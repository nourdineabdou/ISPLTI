<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormationController;

use App\Http\Controllers\CourController;

use App\Http\Controllers\LangueController;

use App\Http\Controllers\ExperienceController;

// route groupe expériences
Route::group(['middleware' => ['auth'], 'prefix' => 'experiences'], function () {
    Route::get('/', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::get('/create', [ExperienceController::class, 'create'])->name('experiences.create');
    Route::post('/', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::get('/{id}/edit', [ExperienceController::class, 'edit'])->name('experiences.edit');
    Route::put('/{id}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('/{id}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');
});

// langue controller
Route::group(['middleware' => ['auth'], 'prefix' => 'languages'], function () {
    Route::get('/', [LangueController::class, 'index'])->name('languages.index');
    Route::get('/create', [LangueController::class, 'create'])->name('languages.create');
    Route::post('/', [LangueController::class, 'store'])->name('languages.store');
    Route::get('/{id}/edit', [LangueController::class, 'edit'])->name('languages.edit');
    Route::put('/{id}', [LangueController::class, 'update'])->name('languages.update');
    Route::delete('/{id}', [LangueController::class, 'destroy'])->name('languages.destroy');
});


// Route pour les cours
Route::group(['middleware' => ['auth'], 'prefix' => 'mescours'], function ()
{
    Route::get('/{etudiantId?}', [CourController::class, 'index'])->name('mescours.index');
    Route::get('/create', [CourController::class, 'create'])->name('mescours.create');
    Route::post('/', [CourController::class, 'store'])->name('mescours.store');
    Route::get('/{id}', [CourController::class, 'show'])->name('mescours.show');
    Route::get('/{id}/edit', [CourController::class, 'edit'])->name('mescours.edit');
    Route::put('/{id}', [CourController::class, 'update'])->name('mescours.update');
    Route::delete('/{id}', [CourController::class, 'destroy'])->name('mescours.destroy');
    // Route pour télécharger le cours
    Route::get('/{id}/download', [CourController::class, 'download'])->name('mescours.download');
    // Route pour activer le cours
    Route::get('/{id}/activer', [CourController::class, 'activer'])->name('mescours.activer');
});

// route groupe formations


Route::group(['middleware' => ['auth'], 'prefix' => 'formations'], function () {
    Route::get('/', [FormationController::class, 'index'])->name('formations.index');
    Route::get('/create', [FormationController::class, 'create'])->name('formations.create');
    Route::post('/', [FormationController::class, 'store'])->name('formations.store');
    Route::get('/{id}', [FormationController::class, 'show'])->name('formations.show');
    Route::get('/{id}/edit', [FormationController::class, 'edit'])->name('formations.edit');
    Route::put('/{id}', [FormationController::class, 'update'])->name('formations.update');
    Route::delete('/{id}', [FormationController::class, 'destroy'])->name('formations.destroy');
});
