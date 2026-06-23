<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index.alias');
Route::post('/transaction/enter', [TransactionController::class, 'enter'])->name('transaction.enter');
Route::post('/transaction/exit', [TransactionController::class, 'exit'])->name('transaction.exit');
Route::get('/transaction/ticket/{id}', [TransactionController::class, 'ticket'])->name('transaction.ticket');
Route::get('/transaction/{id}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/transaction/{id}', [TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');


Route::prefix('location')->name('location.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('/create', [LocationController::class, 'create'])->name('create');
    Route::post('/', [LocationController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [LocationController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LocationController::class, 'update'])->name('update');
    Route::delete('/{id}', [LocationController::class, 'destroy'])->name('destroy');
});


Route::prefix('vehicle-type')->name('vehicle-type.')->group(function () {
    Route::get('/', [VehicleTypeController::class, 'index'])->name('index');
    Route::get('/create', [VehicleTypeController::class, 'create'])->name('create');
    Route::post('/', [VehicleTypeController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [VehicleTypeController::class, 'edit'])->name('edit');
    Route::put('/{id}', [VehicleTypeController::class, 'update'])->name('update');
    Route::delete('/{id}', [VehicleTypeController::class, 'destroy'])->name('destroy');
});


Route::prefix('report')->name('report.')->group(function () {
    Route::get('/location', [ReportController::class, 'locationReport'])->name('location');
    Route::get('/transaction', [ReportController::class, 'transactionReport'])->name('transaction');
});
