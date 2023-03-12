<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
Route::post('/transactions/update-flagged', [TransactionController::class, 'updateFlagged'])->name('transactions.update-flagged');






