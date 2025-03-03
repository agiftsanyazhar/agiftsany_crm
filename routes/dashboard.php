<?php

use App\Http\Controllers\{
    CustomerController,
    LeadController,
    ProductController,
    ProjectController
};
use Illuminate\Support\Facades\Route;

Route::prefix('lead')->name('lead.')->middleware('auth.admin-manager')->group(function () {
    Route::get('/', [LeadController::class, 'index'])->name('index');
    Route::post('/update-status/{id}', [LeadController::class, 'updateStatus'])->name('update-status');
});

Route::prefix('project')->name('project.')->middleware('auth.admin-manager')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::post('/update-status/{id}', [ProjectController::class, 'updateStatus'])->name('update-status');
});

Route::prefix('product')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/store', [ProductController::class, 'store'])->name('store')->middleware('auth.admin');
    Route::post('/update', [ProductController::class, 'update'])->name('update')->middleware('auth.admin');
    Route::post('/buy-product/{id}', [ProductController::class, 'buyProduct'])->name('buy-product')->middleware('auth.customer');
    Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy')->middleware('auth.admin');
});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/show/{id}', [CustomerController::class, 'show'])->name('show');
});
