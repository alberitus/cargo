<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KapalController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'rolemanager:customer_service,admin,supervisor'])->get('/', [DashboardController::class, 'index'])->name('index');
Route::middleware(['auth', 'verified', 'rolemanager:customer_service,admin,supervisor'])->get('index', [DashboardController::class, 'index'])->name('index');


Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/invoice/list', [InvoiceController::class, 'list'])->name('invoice.list');
    Route::post('/invoice/delete', [InvoiceController::class, 'deleteItem'])->name('deleteItem');
    Route::get('/invoice/loadCart', [InvoiceController::class, 'loadCart'])->name('loadCart');
    Route::post('/invoice/update-cart', [InvoiceController::class, 'updateCart'])->name('updateCart');
    Route::post('/invoice/update-price', [InvoiceController::class, 'updatePrice'])->name('updatePrice');
    Route::post('/invoice/addItem', [InvoiceController::class, 'addItem'])->name('addItem');
    Route::post('/invoice/submit-transaction', [InvoiceController::class, 'store'])->name('store');
    Route::get('/invoice/report', [InvoiceController::class, 'report'])->name('invoice.report');
    Route::get('/invoice/pdf', [InvoiceController::class, 'export_pdf'])->name('invoice.pdf');
    Route::post('/invoice/save-transaction-details', [InvoiceController::class, 'saveTransactionDetails'])->name('invoice.inv');
    Route::resource('invoice', InvoiceController::class);
})->middleware('auth');

Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
    Route::post('/company/submit', [CompanyController::class, 'submit'])->name('company.submit');
    Route::post('/company/update/{company_id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company/delete/{company_id}', [CompanyController::class, 'destroy'])->name('company.delete');
    Route::resource('company', CompanyController::class);

    Route::post('/job/submit', [JobController::class, 'submit'])->name('job.submit');
    Route::post('/job/update/{job_id}', [jobController::class, 'update'])->name('job.update');
    Route::delete('/job/delete/{job_id}', [jobController::class, 'destroy'])->name('job.delete');
    Route::resource('job', JobController::class);

    // kapal
    Route::post('/kapal/submit', [KapalController::class,'submit'])->name('kapal.submit');
    Route::post('/kapal/update/{kapal_id}', [KapalController::class, 'update'])->name('kapal.update');
    Route::delete('/kapal/delete/{kapal_id}', [KapalController::class, 'destroy'])->name('kapal.delete');
    Route::resource('kapal', KapalController::class);
});

Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
    Route::post('/item/submit', [ItemController::class, 'submit'])->name('item.submit');
    Route::post('/item/update/{item_id}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/delete/{item_id}', [ItemController::class, 'destroy'])->name('item.delete');
    Route::resource('item', ItemController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth', 'verified', 'rolemanager:supervisor')->group(function () {
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/profile/edit/{id}', [ProfileController::class, 'editById'])->name('profile.editById');
    Route::patch('/profile/edit/{id}', [ProfileController::class, 'updateById'])->name('profile.updateById');
    Route::post('/reset-password/{id}', [ProfileController::class, 'resetPassword'])->name('reset.password');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroyById'])->name('profile.destroyById'); 
});

Route::middleware('auth')->group(function () {
    Route::post('/user/add', [ProfileController::class, 'store'])->name('user.submit');
});


// // item
// Route::resource('item', ItemController::class);

// report
Route::resource('report', ReportController::class);
// Route::get('/pdf', [InvoiceController::class, 'export_pdf']);
// Route::get('/csv', [InvoiceController::class, 'export_csv']);
// Route::get('/excel', [InvoiceController::class, 'export_excel']);
// Route::get('/print', [InvoiceController::class, 'print_invoice']);

// kapal
Route::resource('kapal', KapalController::class);

require __DIR__.'/auth.php';
