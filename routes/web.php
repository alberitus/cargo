<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'rolemanager:admin'])->group(function () {

    // Invoice routes
    Route::get('/invoice/list', [InvoiceController::class, 'list'])->name('invoice.list');
    Route::get('/invoice/report', [InvoiceController::class, 'report'])->name('invoice.report');
    Route::get('/invoice/pdf', [InvoiceController::class, 'export_pdf'])->name('invoice.pdf');
    Route::resource('invoice', InvoiceController::class);

    // Job routes
    Route::resource('job', JobController::class);
});

Route::middleware(['auth', 'rolemanager:customer_service'])->group(function () {

    // Company routes
    Route::post('/company/submit', [CompanyController::class, 'submit'])->name('company.submit');
    Route::post('/company/update/{company_id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company/delete/{company_id}', [CompanyController::class, 'destroy'])->name('company.delete');
    Route::resource('company', CompanyController::class);
});

require __DIR__.'/auth.php';
