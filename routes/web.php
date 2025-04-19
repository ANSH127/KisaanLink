<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmerController;


Route::get('/signup', [UserController::class, 'showSignupPage'])->name('signup');
Route::get('/login', [UserController::class, 'showLoginPage'])->name('login');
Route::post('/signup', [UserController::class, 'handleSignup'])->name('handleSignup');
Route::post('/login', [UserController::class, 'handleLogin'])->name('handleLogin');

Route::get('/add-product', [FarmerController::class, 'showAddProductForm'])->name('addProduct');
Route::post('/add-product', [FarmerController::class, 'handleAddProduct'])->name('handleAddProduct');
Route::get('/products', [FarmerController::class, 'showProductList'])->name('products');
Route::delete('/products/{id}', [FarmerController::class, 'deleteProduct'])->name('deleteProduct');
Route::get('/products/{id}/edit', [FarmerController::class, 'editProductForm'])->name('editProduct');
Route::put('/products/{id}', [FarmerController::class, 'updateProduct'])->name('updateProduct');
// Route::view('/dashboard', 'Dashboard')->name('dashboard');