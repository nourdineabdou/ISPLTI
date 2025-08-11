<?php

use App\Http\Controllers\Auth\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'roles','middleware' => ['auth'/*, 'password.changed'*/]], function (){
    Route::get('', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/select', [RoleController::class, 'getData'])->name('roles.select');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::put('/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/{id}/permission', [RoleController::class, 'permission'])->name('roles.permission');
});
