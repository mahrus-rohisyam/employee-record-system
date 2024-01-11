<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontendController;
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

// Route::get('/login', function () {
//     return view('login');
// });

Route::group(['prefix' => ''], function () {
    Route::get('/login', [FrontendController::class, 'loginView'])->name('login');
    Route::get('/register', [FrontendController::class, 'registerView'])->name('Register');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('Auth Login');
    Route::post('/register', [AuthController::class, 'register'])->name('Auth Register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('Logout');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('Auth Forgot Password');
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('Employee');

    Route::get('/add', [EmployeeController::class, 'addEmployee'])->name('Add Employee');

    Route::post('/create', [EmployeeController::class, 'createEmployee'])->name('Create Employee');

    Route::get('/detail/{id}', [EmployeeController::class, 'detailEmployee'])->name('Detail Employee');

    Route::post('/update/{id}', [EmployeeController::class, 'updateEmployee'])->name('Update Employee');

    Route::get('/delete/{id}', [EmployeeController::class, 'deleteEmployee'])->name('Delete Employee');

    Route::get('/detail/pdf/{id}', [EmployeeController::class, 'pdfEmployee'])->name('PDF Employee');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('Dashboard');
});

Route::group(['middleware' => 'admin'], function () {
});
