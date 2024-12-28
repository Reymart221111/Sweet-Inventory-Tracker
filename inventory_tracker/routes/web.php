<?php

use App\Http\Controllers\Account\UserAccountController;
use App\Http\Controllers\Audit\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Feedbacks\FeedbackController;
use App\Http\Controllers\ItemCategories\ItemCategoryController;
use App\Http\Controllers\ItemOrders\OrderController;
use App\Http\Controllers\ItemProducts\ItemProductController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\EnsureAdminMiddleware;
use App\Http\Middleware\EnsureEmployeeMiddleware;
use App\Http\Middleware\EnsureManagerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login_user');

Route::get('/create-symlink', [LinkController::class, 'createSymlink']);

Route::middleware(['auth', EnsureAdminMiddleware::class])->group(function () {
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/accounts')->name('accounts.')->group(function () {
            Route::get('/settings', [UserAccountController::class, 'showAccountSettingsPage'])->name('settings');
            Route::get('/password', [UserAccountController::class, 'showAccountPasswordPage'])->name('password');
            Route::get('/profile', [UserAccountController::class, 'showAccountProfilePage'])->name('profile');
        });

        Route::get('/item-categories', [ItemCategoryController::class, 'index'])->name('item-categories');
        Route::get('/item-products', [ItemProductController::class, 'index'])->name('item-products');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/pos', [TransactionController::class, 'index'])->name('pos');

        Route::prefix('/orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/order-details/{order}', [OrderController::class, 'showOrderDetails'])->name('show');
        });

        Route::get('/audit-trails', [AuditController::class, 'index'])->name('audit');

        Route::prefix('feedbacks')->name('feedbacks.')->group(function () {
            Route::get('/', [FeedbackController::class, 'index'])->name('index');
            Route::get('/{feedback}', [FeedbackController::class, 'view'])->name('view');
        });
    });
});

Route::middleware(['auth', EnsureManagerMiddleware::class])->group(function () {
    Route::prefix('/manager')->name('manager.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/accounts')->name('accounts.')->group(function () {
            Route::get('/settings', [UserAccountController::class, 'showAccountSettingsPage'])->name('settings');
            Route::get('/password', [UserAccountController::class, 'showAccountPasswordPage'])->name('password');
            Route::get('/profile', [UserAccountController::class, 'showAccountProfilePage'])->name('profile');
        });

        Route::get('/item-categories', [ItemCategoryController::class, 'index'])->name('item-categories');
        Route::get('/item-products', [ItemProductController::class, 'index'])->name('item-products');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/pos', [TransactionController::class, 'index'])->name('pos');

        Route::prefix('/orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/order-details/{order}', [OrderController::class, 'showOrderDetails'])->name('show');
        });

        Route::get('/audit-trails', [AuditController::class, 'index'])->name('audit');

        Route::get('/submit-feedback', [FeedbackController::class, 'index'])->name('submit-feedback');
    });
});

Route::middleware(['auth', EnsureEmployeeMiddleware::class])->group(function () {
    Route::prefix('/employee')->name('employee.')->group(function () {
        Route::prefix('/accounts')->name('accounts.')->group(function () {
            Route::get('/settings', [UserAccountController::class, 'showAccountSettingsPage'])->name('settings');
            Route::get('/password', [UserAccountController::class, 'showAccountPasswordPage'])->name('password');
            Route::get('/profile', [UserAccountController::class, 'showAccountProfilePage'])->name('profile');
        });

       
        Route::get('/pos', [TransactionController::class, 'index'])->name('pos');
        Route::get('/item-products', [ItemProductController::class, 'index'])->name('item-products');

        Route::get('/submit-feedback', [FeedbackController::class, 'index'])->name('submit-feedback');
    });
});
