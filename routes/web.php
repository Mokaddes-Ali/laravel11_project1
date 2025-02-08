<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Auth;

Route::get('otp-request', function () {
    return view('otp.request');
});

Route::get('otp-verify', function () {
    return view('otp.verify');
});

Route::post('otp-request', [OtpController::class, 'requestOtp'])->name('otp.request');
Route::post('otp-verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');


Route::get('/dashboard', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('lang.switch');


Route::get('/notifications/mark-all-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAllAsRead');


Route::middleware('auth')->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('index');
    // Route::post('/client/submit', [ClientController::class, 'create'])->name('create');
    Route::get('/show/client', [ClientController::class, 'show']) -> name('client.show');
    Route::get('/edit/client/{id}', [ClientController::class, 'edit']);
    Route::post('/client/update', [ClientController::class, 'update']);
    Route::get('/delete/{id}', [ClientController::class, 'destroy']);
    Route::get('/client/{client}', [ClientController::class, 'showClientInfo'])->name('client.shows');
    Route::get('/client/show/{id}', [ClientController::class, 'singleClientshow']);
    Route::post('/admin/applications/{client}/approve', [ClientController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/applications/{client}/reject', [ClientController::class, 'reject'])->name('admin.reject');

// Client routes
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('index');
    Route::post('/project/submit', [ProjectController::class, 'store'])->name('store');
    Route::get('/show/project', [ProjectController::class, 'projectshow'])->name('projectshow');
    Route::get('/edit/project/{id}', [ProjectController::class, 'projectedit'])->name('projectedit');
    Route::post('/project/update', [ProjectController::class, 'projectupdate'])->name('projectupdate');
    Route::post('/delete/{id}', [ProjectController::class, 'projectdestroy'])->name('projectdestroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/income', [IncomeController::class, 'incomeindex'])->name('incomeindex');
    Route::post('/income/submit', [IncomeController::class, 'incomestore'])->name('incomestore');
    Route::get('/show/income', [IncomeController::class, 'incomeshow'])->name('incomeshow');
    Route::get('/income/edit/{id}', [IncomeController::class, 'edit'])->name('incomeedit');
    Route::post('/income/update', [IncomeController::class, 'update'])->name('incomeupdate');
    Route::get('/invoice/filter', [IncomeController::class, 'filter'])->name('invoice.filter');
    Route::delete('/income/delete/{id}', [IncomeController::class, 'destroy'])->name('income.delete');
    Route::get('/invoice/search', [IncomeController::class, 'search'])->name('invoice.search');
    Route::get('/project/details/{id}', [IncomeController::class, 'fetchProjectDetails']);
});


Route::middleware('auth')->group(function () {
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expenseindex');
    Route::post('/expense/submit', [ExpenseController::class, 'store'])->name('expensestore');
    Route::get('/show/expense', [ExpenseController::class, 'show'])->name('expenseshow');
    Route::get('/expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expenseedit');
    Route::post('/expense/update', [ExpenseController::class, 'update'])->name('expenseupdate');
    Route::get('/delete/{id}', [ExpenseController::class, 'destroy'])->name('expensedestroy');
});



Route::middleware('auth')->group(function () {
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});


Route::middleware('auth')->group(function () {
    Route::get('/invoice/create/{id}', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');

 });

Route::middleware('auth')->group(function () {
Route::get('/backup', [BackupController::class, 'createBackup'])->name('backup.create');

});

Route::get('/send-mail', [MailController::class, 'sendMail']);



Route::group(['middleware' => ['auth']], function() {
    Route::get('/user', [UserController::class, 'create']);
    Route::get('/show', [UserController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

      });

Route::middleware('auth')->group(function () {
    Route::resource('loans', LoanController::class);

    });

Route::get('/loans/search', [LoanController::class, 'search'])->name('loans.search');
Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::get('/loans/export/{type}', [LoanController::class, 'export'])->name('loans.export');

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('/role', [RoleController::class, 'create']);

    });






// User routes
Route::middleware('auth')->group(function () {
    Route::get('/application', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/application', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/application/{application}', [ApplicationController::class, 'show'])->name('application.show');
});

// Admin routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::post('/admin/applications/{application}/approve', [ApplicationController::class, 'approve'])->name('admin.applications.approve');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

