<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

Route::get('/', function () {
    return view('home');
});

Route::get('/halo/{nama}', function ($nama) {
    return "Halo, $nama!";
});

Route::get('/form', [PageController::class, 'form']);
Route::post('/form', [ProductController::class, 'addProduct'])->name('upload');
Route::get('/about', [PageController::class, 'about']);
Route::get('/product_list', [ProductController::class, 'data'])->name('product_list');
Route::get('/index', [PageController::class, 'main']);
Route::get('/edit_product/{id}', [PageController::class, 'edit']);
Route::put('/update/{id}', [ProductController::class, 'update']);

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.submit');
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});


Route::get('/transaction', [TransactionController::class, 'index']);
Route::post('/transaction', [TransactionController::class, 'store']);
Route::get('/transaction_history', [TransactionController::class, 'history']);
Route::get('/report_profit', [TransactionController::class, 'reportProfit']);
Route::get('/report_profit', [TransactionController::class, 'reportProfit'])->name('report.profit');
Route::get('/export_excel', [TransactionController::class, 'exportExcel'])->name('export.excel');
Route::get('/export_receipt', [ExportController::class, 'exportReceipt']);

Route::get('/export_receipt/{id}', [ExportController::class, 'exportReceipt'])->name('export.receipt');
Route::delete('/transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.delete');

Route::get('/chart_transactions', [TransactionController::class, 'chartTransactions'])->name('chart.transactions');