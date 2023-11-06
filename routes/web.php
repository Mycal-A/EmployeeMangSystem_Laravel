<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmpFamilyController;
use App\Http\Controllers\Admin\EmpEducationController;
use App\Http\Controllers\Admin\EmpExperienceController;
use App\Http\Controllers\Session\SessionsController;
use App\Http\Controllers\Admin\CreateUserController;

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

Route::get('/', [SessionsController::class, 'showLoginForm'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'login']);
Route::get('/logout', [SessionsController::class, 'logout'])->middleware('auth');

Route::middleware('admin')->group(function(){
    Route::get('/adminHome', [AdminController::class, 'index']);
    Route::get('/admin/edit/employee/{employee}', [AdminController::class, 'show']);
    Route::patch('/admin/employee/update/{employee}', [AdminController::class, 'updateEmployee']);
    Route::delete('/admin/emp/delete/{employee}', [AdminController::class, 'destroy']);
    Route::get('/createUser', [CreateUserController::class, 'show']);
    Route::post('/createUser', [CreateUserController::class, 'store']);
    Route::patch('/toggleAccess/{id}', [EmployeeController::class, 'toggleAccess']);
});

Route::delete('/admin/delete/family/record/{id}', [EmpFamilyController::class, 'deleteFamilyRecord']);
Route::delete('/admin/delete/education/record/{id}', [EmpEducationController::class, 'deleteEducationRecord']);
Route::delete('/admin/delete/experience/record/{id}', [EmpExperienceController::class, 'deleteExperienceRecord']);

Route::get('/employeeHome', [EmployeeController::class, 'show'])->middleware('auth');
Route::patch('/employee/update/{id}', [EmployeeController::class, 'updateEmployee']);
