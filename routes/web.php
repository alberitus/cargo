<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ConsigneController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'rolemanager:customer_service,admin,supervisor'])->get('/', [DashboardController::class, 'index'])->name('index');
Route::middleware(['auth', 'verified', 'rolemanager:customer_service,admin,supervisor'])->get('index', [DashboardController::class, 'index'])->name('index');


Route::middleware(['auth'])->group(function () {
    Route::get('/invoice/list', [TransactionController::class, 'list'])->name('invoice.list');
    Route::post('/invoice/delete', [TransactionController::class, 'deleteItem'])->name('deleteItem');
    Route::get('/invoice/loadCart', [TransactionController::class, 'loadCart'])->name('loadCart');
    Route::post('/invoice/update-cart', [TransactionController::class, 'updateCart'])->name('updateCart');
    Route::post('/invoice/update-price', [TransactionController::class, 'updatePrice'])->name('updatePrice');
    Route::post('/invoice/addItem', [TransactionController::class, 'addItem'])->name('addItem');
    Route::post('/invoice/submit-transaction', [TransactionController::class, 'store'])->name('store');
    Route::get('/invoice/report', [TransactionController::class, 'report'])->name('invoice.report');
    Route::get('/invoice/pdf', [TransactionController::class, 'export_pdf'])->name('invoice.pdf');
    Route::post('/invoice/save-transaction-details', [TransactionController::class, 'saveTransactionDetails'])->name('invoice.inv');
    Route::resource('transaction', TransactionController::class);
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

    // consigne
    Route::post('/consigne/submit', [ConsigneController::class,'submit'])->name('consigne.submit');
    Route::post('/consigne/update/{consigne_id}', [ConsigneController::class, 'update'])->name('consigne.update');
    Route::delete('/consigne/delete/{consigne_id}', [ConsigneController::class, 'destroy'])->name('consigne.delete');
    Route::resource('consigne', ConsigneController::class);
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
    Route::get('/profile/edit/{id}', [ProfileController::class, 'editById'])->name('profile.editById');
    Route::patch('/profile/edit/{id}', [ProfileController::class, 'updateById'])->name('profile.updateById');
    Route::post('/reset-password/{id}', [ProfileController::class, 'resetPassword'])->name('reset.password');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroyById'])->name('profile.destroyById'); 
    Route::resource('profile', ProfileController::class);

});

Route::middleware('auth')->group(function () {
    Route::post('/user/add', [ProfileController::class, 'store'])->name('user.submit');
});


// report
Route::middleware(['auth', 'rolemanager:admin'])->group(function () {
Route::get('/report/company', [ReportController::class, 'company'])->name('report.company');
Route::resource('report', ReportController::class);
Route::get('/report/item', [ReportController::class, 'item'])->name('report.item');
// Route::get('/pdf', [InvoiceController::class, 'export_pdf']);
// Route::get('/csv', [InvoiceController::class, 'export_csv']); 
// Route::get('/excel', [InvoiceController::class, 'export_excel']);
// Route::get('/print', [InvoiceController::class, 'print_invoice']);
});

// consigne
Route::resource('consigne', ConsigneController::class);

require __DIR__.'/auth.php';
