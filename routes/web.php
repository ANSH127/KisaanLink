<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\OrderController;

Route::redirect('/', '/dashboard');
Route::get('/signup', [UserController::class, 'showSignupPage'])->name('signup');
Route::get('/login', [UserController::class, 'showLoginPage'])->name('login');
Route::post('/signup', [UserController::class, 'handleSignup'])->name('handleSignup');
Route::post('/login', [UserController::class, 'handleLogin'])->name('handleLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/add-product', [FarmerController::class, 'showAddProductForm'])->name('addProduct');
Route::post('/add-product', [FarmerController::class, 'handleAddProduct'])->name('handleAddProduct');
Route::get('/products', [FarmerController::class, 'showProductList'])->name('products');
Route::delete('/products/{id}', [FarmerController::class, 'deleteProduct'])->name('deleteProduct');
Route::get('/products/{id}/edit', [FarmerController::class, 'editProductForm'])->name('editProduct');
Route::put('/products/{id}', [FarmerController::class, 'updateProduct'])->name('updateProduct');


Route::get('/f/orders', [FarmerController::class, 'showOrders'])->name('orders');
Route::post('/f/orders/{id}/accept', [FarmerController::class, 'acceptOrder'])->name('acceptOrder');
Route::post('/f/orders/{id}/reject', [FarmerController::class, 'rejectOrder'])->name('rejectOrder');
Route::post('/f/orders/{id}/counter', [FarmerController::class, 'counterOffer'])->name('counterOffer');



Route::get('/dashboard', [BuyerController::class, 'showDashboard'])->name('dashboard');
Route::get('/productdetail/{id}', [BuyerController::class, 'showProductDetails'])->name('productDetails');
Route::get('/orders', [BuyerController::class, 'showOrders'])->name('orders');
Route::get('/orders/{id}', [BuyerController::class, 'showOrderDetails'])->name('orderDetails');
Route::post('/orders/{id}/cancel', [BuyerController::class, 'cancelOrder'])->name('cancelOrder');






Route::get('/checkout/{product_id}', [OrderController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout/{product_id}', [OrderController::class, 'handleCheckout'])->name('handleCheckout');



