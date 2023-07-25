<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Route for the homepage
 */
Route::get('/', [Controllers\Controller::class, 'index'])->name('home');

/**
 * All the routes for branch office (GET, POST, PUT, DELETE)
 */
Route::prefix('branchOffice')->group(function () {
    Route::get('/list', [Controllers\BranchOfficeController::class, 'list'])->name('branchOffice.list');
    Route::get('/create', [Controllers\BranchOfficeController::class, 'edit'])->name('branchOffice.create');
    Route::post('/create', [Controllers\BranchOfficeController::class, 'save'])->name('branchOffice.crete');
    Route::get('/edit/{branchOffice}', [Controllers\BranchOfficeController::class, 'edit'])->name('branchOffice.edit');
    Route::put('/edit/{branchOffice}', [Controllers\BranchOfficeController::class, 'update'])->name('branchOffice.edit');
    Route::delete('/delete/{branchOffice}', [Controllers\BranchOfficeController::class, 'delete'])->name('branchOffice.delete');
});

/**
 * All the routes for products (GET, POST, PUT, DELETE)
 */
Route::prefix('products')->group(function () {
    Route::get('/list', [Controllers\ProductsController::class, 'list'])->name('product.list');
    Route::get('/create', [Controllers\ProductsController::class, 'edit'])->name('product.create');
    Route::post('/create', [Controllers\ProductsController::class, 'save'])->name('product.create');
    Route::get('/edit/{product}', [Controllers\ProductsController::class, 'edit'])->name('product.edit');
    Route::put('/edit/{product}', [Controllers\ProductsController::class, 'update'])->name('product.edit');
    Route::delete('/delete/{product}', [Controllers\ProductsController::class, 'delete'])->name('product.delete');
});

/**
 * All the routes for employees (GET, POST, PUT, DELETE)
 */
Route::prefix('employees')->group(function () {
    Route::get('/list', [Controllers\EmployeesController::class, 'list'])->name('employee.list');
    Route::get('/create', [Controllers\EmployeesController::class, 'edit'])->name('employee.create');
    Route::post('/create', [Controllers\EmployeesController::class, 'save'])->name('employee.create');
    Route::get('/edit/{employee}', [Controllers\EmployeesController::class, 'edit'])->name('employee.edit');
    Route::put('/edit/{employee}', [Controllers\EmployeesController::class, 'update'])->name('employee.edit');
    Route::delete('/delete/{employee}', [Controllers\EmployeesController::class, 'delete'])->name('employee.delete');
});
