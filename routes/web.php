<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');;


Route::middleware(['auth'])->get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware(['auth'])->get('/dashboard', function () {
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
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/{id}', [ProfileController::class, 'editById'])->name('profile.editById');
    Route::patch('/profile/edit/{id}', [ProfileController::class, 'updateById'])->name('profile.updateById');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroyById'])
    ->name('profile.destroyById')
    ->middleware('auth', 'admin'); 
});

Route::middleware('auth')->group(function () {
    Route::post('/user/add', [ProfileController::class, 'store'])->name('user.submit');
});

// item
Route::resource('item', ItemController::class);

// report
Route::resource('report', ReportController::class);
// Route::get('/pdf', [InvoiceController::class, 'export_pdf']);
// Route::get('/csv', [InvoiceController::class, 'export_csv']);
// Route::get('/excel', [InvoiceController::class, 'export_excel']);
// Route::get('/print', [InvoiceController::class, 'print_invoice']);

require __DIR__.'/auth.php';

