<?php

use App\Http\Controllers\ServeurController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'serveurs', 'middleware' => ['auth']], function () {
    Route::get('', [ServeurController::class, 'index'])->name('serveurs.index');
    Route::get('create', [ServeurController::class, 'create'])->name('serveurs.create');
    Route::post('store', [ServeurController::class, 'store'])->name('serveurs.store');
    Route::get('show/{serveur}', [ServeurController::class, 'show'])->name('serveurs.show');
    Route::get('edit/{serveur}', [ServeurController::class, 'edit'])->name('serveurs.edit');
    Route::put('update/{serveur}', [ServeurController::class, 'update'])->name('serveurs.update');
    Route::delete('destroy/{serveur}', [ServeurController::class, 'destroy'])->name('serveurs.destroy');
});
