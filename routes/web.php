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

Route::get('/', [Controllers\Controller::class, 'index']);

Route::prefix('branchOffice')->group(function () {
    Route::get('/list', [Controllers\BranchOfficeController::class, 'list']);
    Route::get('/create', [Controllers\BranchOfficeController::class, 'edit']);
    Route::post('/create', [Controllers\BranchOfficeController::class, 'save']);
    Route::get('/edit/{branchOffice}', [Controllers\BranchOfficeController::class, 'edit']);
    Route::put('/edit/{branchOffice}', [Controllers\BranchOfficeController::class, 'update']);
    Route::delete('/delete/{branchOffice}', [Controllers\BranchOfficeController::class, 'delete']);
});

Route::prefix('products')->group(function () {
    Route::get('/list', [Controllers\ProductsController::class, 'list']);
    Route::get('/create', [Controllers\ProductsController::class, 'edit']);
    Route::post('/create', [Controllers\ProductsController::class, 'save']);
    Route::get('/edit/{product}', [Controllers\ProductsController::class, 'edit']);
    Route::put('/edit/{product}', [Controllers\ProductsController::class, 'update']);
    Route::delete('/delete/{product}', [Controllers\ProductsController::class, 'delete']);
    Route::get('/images/{product}', [Controllers\ProductsController::class, 'image']);
});

Route::prefix('employees')->group(function () {
    Route::get('/list', [Controllers\EmployeesController::class, 'list']);
    Route::get('/create', [Controllers\EmployeesController::class, 'edit']);
    Route::post('/create', [Controllers\EmployeesController::class, 'save']);
    Route::get('/edit/{employee}', [Controllers\EmployeesController::class, 'edit']);
    Route::put('/edit/{employee}', [Controllers\EmployeesController::class, 'update']);
    Route::delete('/delete/{employee}', [Controllers\EmployeesController::class, 'delete']);
});
