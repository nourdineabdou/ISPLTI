<?php

use App\Http\Controllers\Auth\InvitationController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('/profile', function () {
        return view('pages.auth.profile');
    })->name('auth.profile');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('create', [UserController::class, 'create'])->name('users.create');
    Route::post('store', [UserController::class, 'store'])->name('users.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('suspend/{id}', [UserController::class, 'suspend'])->name('users.suspend');
    Route::get('activate/{id}', [UserController::class, 'activate'])->name('users.activate');
    Route::get('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
});

Route::get('/invitation/{token}/accept', [InvitationController::class, 'accept'])->name('invitation.accept');
Route::post('/invitation/send', [InvitationController::class, 'sendInvitation'])->name('invitation.send');
Route::get('/invitation/create', [InvitationController::class, 'create'])->name('invitation.create');
Route::get('/invitation/edit/{id}', [InvitationController::class, 'edit'])->name('invitation.edit');
Route::put('/invitation/update/{id}', [InvitationController::class, 'update'])->name('invitation.update');
Route::post('/invitation/register', [InvitationController::class, 'register'])->name('invitation.register');
