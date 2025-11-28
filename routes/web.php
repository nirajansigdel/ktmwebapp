<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ThemeController;

Route::get('/', function () {
    return redirect('/admin');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/register', 'backend.auth.register')->name('register');

// Frontend placeholder
Route::view('/home', 'frontend.home')->name('frontend.home');

// Locale
Route::post('/locale', [LocaleController::class, 'switch'])->name('locale.switch');
// Theme
Route::post('/theme', [ThemeController::class, 'switch'])->name('theme.switch');

// Backend routes (prefix: /admin)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::view('/', 'backend.dashboard.index')->name('dashboard');
    Route::view('/dashboard', 'backend.dashboard.index')->name('dashboard.index');

    // Item Entry / Details
    Route::prefix('items')->name('items.')->group(function () {
        Route::view('/entry', 'backend.items.entry')->name('entry');
        Route::view('/details', 'backend.items.details')->name('details');
    });

    // Account: income, expense, inventory (account), reports
    Route::prefix('account')->name('account.')->group(function () {
        Route::view('/income', 'backend.account.income')->name('income');
        Route::view('/expense', 'backend.account.expense')->name('expense');
        Route::view('/inventory', 'backend.account.inventory')->name('inventory');
        Route::view('/report', 'backend.account.report')->name('report');
    });

    // Vendors
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::view('/', 'backend.vendor.index')->name('index');
        // In real app use /{id}
        Route::view('/show', 'backend.vendor.show')->name('show');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::view('/income-expense', 'backend.reports.income_expense')->name('income_expense');
        Route::view('/account-statement', 'backend.reports.account_statement')->name('account_statement');
    });

    // Inventory module
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::view('/', 'backend.inventory.index')->name('index');
    });

    // Payments (Amount Paid)
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::view('/', 'backend.payments.index')->name('index');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::view('/profile', 'backend.settings.profile')->name('profile');
        Route::view('/users', 'backend.settings.user_management')->name('users');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::view('/', 'backend.notifications.index')->name('index');
    });

    // Audit
    Route::prefix('audit')->name('audit.')->group(function () {
        Route::view('/', 'backend.audit.index')->name('index');
    });

    // Backup & Restore
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::view('/', 'backend.backup.index')->name('index');
    });
});
