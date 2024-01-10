<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/employee', [EmployeeController::class, 'index'])->name('Employee');

Route::get('/employee/add', [EmployeeController::class, 'addEmployee'])->name('Add Employee');

Route::post('/employee/create', [EmployeeController::class, 'createEmployee'])->name('Create Employee');

Route::get('/employee/detail/{id}', [EmployeeController::class, 'detailEmployee'])->name('Detail Employee');

Route::post('/employee/update/{id}', [EmployeeController::class, 'updateEmployee'])->name('Update Employee');

Route::get('/employee/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('Delete Employee');

Route::get('/employee/detail/pdf/{id}', [EmployeeController::class, 'pdfEmployee'])->name('PDF Employee');
