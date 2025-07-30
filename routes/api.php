<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('orders/pos/create', [OrderController::class, 'orderPosCreate'])->name('orders.pos.create');

Route::post('orders/pos/store', [OrderController::class, 'orderPosStore'])->name('orders.pos.store')
    ->middleware('auth:sanctum');

Route::get('orders/pos', function (){
    return response()->json([
        'message' => 'This is a protected route',
        'status' => 'success'
    ]);
});*/
