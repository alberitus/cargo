<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;


Route::get('/', function () {
    return view('index');
});

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


//job
Route::resource('job', JobController::class);