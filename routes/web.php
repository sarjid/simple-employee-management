<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeInfoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('employee', EmployeeController::class)->except([
        'create', 'edit'
    ]);;
    Route::get('/employee-list', [EmployeeController::class, 'all'])->name('employee.all');

    Route::controller(EmployeeInfoController::class)->group(function () {
        Route::get('employeeinfo', 'index')->name('employeeinfo.index');
        Route::post('employeeinfo', 'store')->name('employeeinfo.store');
    });
});
