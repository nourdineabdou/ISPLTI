<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

// route groupe etudiant
Route::group(['middleware' => ['auth'], 'prefix' => 'etudiants'], function () {
    Route::get('/', [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/create', [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::post('/', [EtudiantController::class, 'store'])->name('etudiants.store');
    Route::get('/{id}', [EtudiantController::class, 'show'])->name('etudiants.show');
    Route::get('/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::delete('/{id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
});
