<?php

use App\Http\Controllers\basicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SalesReportController;

// Landing page
Route::get('/', [VehicleController::class, 'showHomePage'])->name('home');

// About and Contact pages
Route::prefix('/home_pages/pages')->name('home_pages.pages.')->group(function() {
    Route::get('/About', [basicController::class, 'about'])->name('About');
    Route::get('/Contact', [basicController::class, 'contact'])->name('Contact');
});

// Search vehicles
Route::get('/search', [VehicleController::class, 'search'])->name('vehicles.search');

// Authentication routes
Auth::routes();

// Routes for normal users
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::prefix('User')->name('User.')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');

        // Message routes for users
        Route::prefix('Message')->name('Message.')->group(function () {
            Route::get('SendMessage', [MessageController::class, 'sendMessage'])->name('SendMessage');
            Route::post('store', [MessageController::class, 'store'])->name('store');
          
        });

        // Vehicle routes for users
        Route::prefix('Vehicle')->name('Vehicle.')->group(function () {
            Route::get('vehicles', [VehicleController::class, 'showuserPage'])->name('vehicles');
            Route::get('search', [VehicleController::class, 'searchvehicle'])->name('search');
        });

        // Order routes for users
        Route::prefix('Order')->name('Order.')->group(function () {
            Route::get('{vehicle}/reserve', [OrderController::class, 'create'])->name('create');
            Route::post('{vehicle}/reserve', [OrderController::class, 'store'])->name('store');
            Route::get('orders', [OrderController::class, 'index'])->name('index');
            Route::get('search', [OrderController::class, 'search'])->name('search');
            Route::delete('{order}/delete', [OrderController::class, 'destroy'])->name('delete');
        });
        Route::prefix('Payment')->name('Payment.')->group(function () {
            Route::get('{order}/payment', [PaymentController::class, 'showPaymentPage'])->name('payment');
            Route::post('{order}/payment', [PaymentController::class, 'processPayment'])->name('process');
        });
    });
});

// Admin routes
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::prefix('Admin')->name('Admin.')->group(function () {
        Route::prefix('pages')->name('pages.')->group(function () {
            
            Route::get('main', [SalesReportController::class, 'index'])->name('main');
            // Vehicle routes for admin
            Route::prefix('vehicle')->name('vehicle.')->group(function () {
                Route::get('vehicleHome', [VehicleController::class, 'index'])->name('vehicleHome');
                Route::get('create', [VehicleController::class, 'create'])->name('create');
                Route::post('store', [VehicleController::class, 'store'])->name('store');
                Route::get('{vehicle_no}/edit', [VehicleController::class, 'edit'])->name('edit');
                Route::post('{vehicle_no}/update', [VehicleController::class, 'update'])->name('update');
                Route::get('{vehicle_no}/delete', [VehicleController::class, 'delete'])->name('delete');
                Route::get('search', [VehicleController::class, 'adminsearch'])->name('search'); // Search vehicles
            });

            // Customer routes for admin
            Route::prefix('Customer')->name('Customer.')->group(function () {
                Route::get('customerHome', [CustomerController::class, 'index'])->name('customerHome');
                Route::get('create', [CustomerController::class, 'create'])->name('create');
                Route::post('store', [CustomerController::class, 'store'])->name('store');
                Route::get('{id}/edit', [CustomerController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [CustomerController::class, 'update'])->name('update');
                Route::get('{id}/delete', [CustomerController::class, 'delete'])->name('delete');
                Route::get('search', [CustomerController::class, 'search'])->name('search');
            });

            // Message routes for admin
            Route::prefix('message')->name('message.')->group(function () {
                Route::get('inbox', [AdminMessageController::class, 'inbox'])->name('inbox');
                Route::get('{id}/show', [AdminMessageController::class, 'show'])->name('show');
                Route::post('{id}/reply', [AdminMessageController::class, 'reply'])->name('reply');
            });

            // Order routes for admin
            Route::prefix('Orders')->name('Orders.')->group(function () {
                Route::get('index', [OrderController::class, 'adminIndex'])->name('index');
                Route::post('{order}/confirm', [OrderController::class, 'confirm'])->name('confirm');
                Route::post('{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
            });

            // Invoice routes for admin
            Route::prefix('Invoice')->name('Invoice.')->group(function () {
                Route::get('/', [InvoiceController::class, 'index'])->name('invoiceIndex');
                Route::get('/create', [InvoiceController::class, 'create'])->name('create');
                Route::post('/', [InvoiceController::class, 'store'])->name('store');
                Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('show');
                Route::get('/{invoice}/pdf', [InvoiceController::class, 'generatePDF'])->name('generatePDF');
            });
            //payments routes for admin
            Route::prefix('payment')->name('payment.')->group(function () {
                Route::get('paymentdetail',[PaymentController::class, 'showpayment'])->name('paymentdetail');
                Route::post('addAdvancePayment', [PaymentController::class, 'addAdvancePayment'])->name('addAdvancePayment');
            });
            //Report routes for admin
            Route::prefix('Report')->name('Report.')->group(function () {
                Route::get('reportdetails', [ReportController::class, 'index'])->name('reportdetails');
                Route::get('generate', [ReportController::class, 'showGenerateForm'])->name('generate');
                Route::post('store', [ReportController::class, 'generate'])->name('store');
                Route::get('download/{id}', [ReportController::class, 'download'])->name('download');
            });
        });
    });
});