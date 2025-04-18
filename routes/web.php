<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/signup', [UserController::class, 'showSignupPage'])->name('signup');
Route::get('/login', [UserController::class, 'showLoginPage'])->name('login');
Route::post('/signup', [UserController::class, 'handleSignup'])->name('handleSignup');
Route::post('/login', [UserController::class, 'handleLogin'])->name('handleLogin');

Route::view('/add-product','seller.AddProductForm')->name('add-product');