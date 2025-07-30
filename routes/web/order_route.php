<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders' ,'middleware' => ['auth']], function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // pos

// orders.pos.get.meal_line_item
    Route::get('pos/get/meal_line_item/{meal}', [OrderController::class, 'getMealLineItem'])->name('orders.pos.get.meal_line_item');
// orders.pos.payments.create
    Route::post('pos/payments/create/{id}', [OrderController::class, 'createPayment'])->name('orders.pos.payments.create');
    // orders.pos.print
    Route::get('pos/print/{order}', [OrderController::class, 'printOrder'])->name('orders.pos.print');
    // confirmOrder
    Route::get('pos/confirm/{order}', [OrderController::class, 'confirmOrder'])->name('orders.pos.confirm');
    // orders.pos.destroy
    Route::delete('pos/destroy/{order}', [OrderController::class, 'destroy'])->name('orders.pos.destroy');
    // orders.pos.cancel
    Route::get('pos/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.pos.cancel');
});

Route::get('orders/pos/create', [OrderController::class, 'orderPosCreate'])->name('orders.pos.create');
// store
Route::post('orders/pos/store', [OrderController::class, 'orderPosStore'])->name('orders.pos.store');
// get table or vip
Route::get('orders/pos/get/table_or_vip/{id?}', [OrderController::class, 'getTableOrVip'])->name('orders.pos.get.table_or_vip');

// payment-methods
Route::group(['prefix' => 'payment-methods' ,'middleware' => []], function () {
    Route::get('/', [PaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::get('/create', [PaymentMethodController::class, 'create'])->name('payment-methods.create');
    Route::post('/', [PaymentMethodController::class, 'store'])->name('payment-methods.store');
    Route::get('/{paymentMethod}', [PaymentMethodController::class, 'show'])->name('payment-methods.show');
    Route::get('/{paymentMethod}/edit', [PaymentMethodController::class, 'edit'])->name('payment-methods.edit');
    Route::put('/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('payment-methods.update');
    Route::delete('/{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');
});


