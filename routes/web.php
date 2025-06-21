<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    // Arahkan halaman utama ke daftar inventaris untuk contoh ini
    return redirect()->route('items.index');
});

// Route tambahan untuk download PDF harus diletakkan SEBELUM resource agar tidak tertimpa
Route::get('/items/download-pdf', [ItemController::class, 'downloadPdf'])->name('items.downloadPdf');

// Resource route otomatis buat semua CRUD termasuk show, edit, update, delete
Route::resource('items', ItemController::class);
