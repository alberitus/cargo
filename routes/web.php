<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

//invoice
Route::get('/invoice/list', [InvoiceController::class, 'list']);
Route::get('/invoice/report', [InvoiceController::class, 'report']);
Route::get('/invoice/pdf', [InvoiceController::class, 'export_pdf']);
Route::resource('invoice', InvoiceController::class);

//company
Route::post('/company/submit', [CompanyController::class, 'submit'])->name('company.submit');
Route::post('/company/update/{company_id}', [CompanyController::class, 'update'])->name('company.update');
Route::delete('/company/delete/{company_id}', [CompanyController::class, 'destroy'])->name('company.delete');
Route::resource('company', CompanyController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
