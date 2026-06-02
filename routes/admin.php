<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TenantsController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Route;

Route::post('/config/logout', [AdminController::class, 'logout'])->name('config.logout');
Route::resource('/', DashboardController::class);
Route::resource('/tenants', TenantsController::class);
Route::resource('/messages', MessagesController::class);
Route::resource('/config', AdminController::class);
Route::resource('/permission', PermissionsController::class);
Route::resource('/role', RolesController::class);