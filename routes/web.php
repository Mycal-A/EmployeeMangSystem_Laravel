<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmpFamilyController;
use App\Http\Controllers\Admin\EmpEducationController;
use App\Http\Controllers\Admin\EmpExperienceController;
use App\Http\Controllers\Session\SessionsController;
use App\Http\Controllers\Admin\CreateUserController;
use App\Http\Controllers\PdfController;

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

Route::get('/', [SessionsController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'login']);
Route::get('/logout', [SessionsController::class, 'logout'])->middleware('auth');

Route::middleware('admin')->group(function(){
    Route::get('/adminHome', [AdminController::class, 'index']);
    Route::get('/admin/edit/employee/{employee}', [AdminController::class, 'show']);
    Route::patch('/admin/employee/update/{employee}', [AdminController::class, 'update']);
    Route::delete('/admin/emp/delete/{employee}', [AdminController::class, 'destroy']);
    Route::patch('/toggleAccess/{id}', [AdminController::class, 'toggleAccess']);
    Route::get('/createUser', [CreateUserController::class, 'show']);
    Route::post('/createUser', [CreateUserController::class, 'store']);
    Route::get('/admin/download/employeeDetails', [AdminController::class, 'downloadEmployeesData']);
    Route::post('/admin/bulkUpload', [AdminController::class, 'importEmployeesData']);
});

Route::delete('/admin/delete/family/record/{id}', [EmpFamilyController::class, 'deleteFamilyRecord']);
Route::delete('/admin/delete/education/record/{id}', [EmpEducationController::class, 'deleteEducationRecord']);
Route::delete('/admin/delete/experience/record/{id}', [EmpExperienceController::class, 'deleteExperienceRecord']);

Route::get('/employeeHome', [EmployeeController::class, 'show'])->middleware('auth');
Route::patch('/employee/update/{employee}', [EmployeeController::class, 'update'])->middleware('auth');
Route::get('/employee/download/pdf/{employee}', [pdfController::class, 'generatePdf'])->middleware('auth');
