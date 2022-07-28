<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductsController;
use App\Http\Controllers\FiltersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//PRODUCTS
Route::get('/products', [ProductController::class, 'index']); //mostra tutti i prodotti disponibili
Route::post('/products', [ProductController::class, 'store']);//aggiunge un prodotto
Route::put('/products/{id}', [ProductController::class, 'update']);//modifica di un prodotto
Route::delete('/products/{id}', [ProductController::class, 'destroy']);//eliminazione disponibilità prodotto


//ORDERS
Route::get('/orders', [OrderController::class, 'index']);//mostra tutti gli ordini attivi
// Route::get('/orders/{destination_order}', [OrderController::class, 'index']);//mostra tutti gli ordini attivi
Route::post('/orders', [OrderController::class, 'store']);//aggiungi prodotti ad un ordine
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);


// //ORDER_PRODUCTS
// Route::get('/order-products', [OrderProductsController::class, 'index']);
// Route::post('/order-products', [OrderProductsController::class, 'store']);
// Route::put('/order-products/{id}', [OrderProductsController::class, 'update']);
// Route::delete('/order-products/{id}', [OrderProductsController::class, 'destroy']);


//FILTERS CHECKS
Route::post('/co2', [FiltersController::class, 'co2']);
// Route::get('/forcountry', [FiltersController::class, 'forcountry']);
// Route::get('/forproduct', [FiltersController::class, 'forproduct']);
// Route::post('/fortemp', [FiltersController::class, 'fortemp']);


// Route::post('/products/{co2}', [ProductController::class, 'store']);//aggiunge un prodotto


