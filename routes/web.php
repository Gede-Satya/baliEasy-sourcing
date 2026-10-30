<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/lang/{locale}', [HomeController::class, 'changeLocale'])->name('locale.switch');
Route::post('/rfq', [HomeController::class, 'submitRfq'])->name('rfq.submit');
Route::post('/newsletter', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
