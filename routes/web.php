<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReportController;


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

//item

Route::resource('item', ItemController::class);

//report

Route::resource('report', ReportController::class);
// Route::get('/pdf', [InvoiceController::class, 'export_pdf']);
// Route::get('/csv', [InvoiceController::class, 'export_csv']);
// Route::get('/excel', [InvoiceController::class, 'export_excel']);
// Route::get('/print', [InvoiceController::class, 'print_invoice']);