<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories.index');
Route::get('/categories/{slug}', [HomeController::class, 'showCategory'])->name('categories.show');
Route::get('/where-to-stay-and-eat', [HomeController::class, 'stayEat'])->name('stay-eat');
Route::get('/stay-eat', fn () => redirect()->route('stay-eat'));
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/lang/{locale}', [HomeController::class, 'changeLocale'])->name('locale.switch');
Route::post('/rfq', [HomeController::class, 'submitRfq'])->name('rfq.submit');
Route::post('/newsletter', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
