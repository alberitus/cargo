<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'rolemanager:admin,customer_service,manager'])->get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');;


Route::middleware(['auth', 'rolemanager:admin,customer_service,manager'])->get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware(['auth', 'rolemanager:admin,customer_service,manager'])->get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/invoice/list', [InvoiceController::class, 'list'])->name('invoice.list');
    Route::get('/invoice/report', [InvoiceController::class, 'report'])->name('invoice.report');
    Route::get('/invoice/pdf', [InvoiceController::class, 'export_pdf'])->name('invoice.pdf');
    Route::resource('invoice', InvoiceController::class);
})->middleware('auth');

Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
    Route::post('/company/submit', [CompanyController::class, 'submit'])->name('company.submit');
    Route::post('/company/update/{company_id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company/delete/{company_id}', [CompanyController::class, 'destroy'])->name('company.delete');
    Route::resource('company', CompanyController::class);

    Route::resource('job', JobController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
