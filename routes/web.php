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
Route::resource('company', CompanyController::class);


//job
Route::resource('job', JobController::class);