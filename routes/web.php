<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

Route::get('/', [StockController::class, 'index'])->name('home');
Route::post('/submit-form', [StockController::class, 'submitForm'])->name('form.submit');
