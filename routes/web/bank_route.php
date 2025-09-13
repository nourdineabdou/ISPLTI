<?php

//use App\Http\Controllers\Stricture\BankController;
use Illuminate\Support\Facades\Route;

//Route::resource('banks', BankController::class);

// route reservations
// Route::prefix('reservations')->name('reservations.')->group(function () {
//     Route::get('/', [App\Http\Controllers\ReservationController::class, 'index'])->name('index');
//     Route::get('/create', [App\Http\Controllers\ReservationController::class,   'create'])->name('create');
//     Route::post('/', [App\Http\Controllers\ReservationController::class, 'store'])->name('store');
//     Route::get('/{id}/edit', [App\Http\Controllers\ReservationController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [App\Http\Controllers\ReservationController::class, 'update'])->name('update');
//     Route::delete('/{id}', [App\Http\Controllers\ReservationController::class, 'destroy'])->name('destroy');
// });
// route residences
// Route::group(['middleware' => ['auth'], 'prefix' => 'residences'], function () {
//     Route::get('', [App\Http\Controllers\ResidenceController::class, 'index'])->name('residences.index');
//     Route::get('create', [App\Http\Controllers\ResidenceController::class, 'create'])->name('residences.create');
//     Route::post('store', [App\Http\Controllers\ResidenceController::class, 'store'])->name('residences.store');
//     Route::get('edit/{residence}', [App\Http\Controllers\ResidenceController::class, 'edit'])->name('residences.edit');
//     Route::put('update/{residence}', [App\Http\Controllers\ResidenceController::class, 'update'])->name('residences.update');
//     Route::delete('destroy/{residence}', [App\Http\Controllers\ResidenceController::class, 'destroy'])->name('residences.destroy');
// });
