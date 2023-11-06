<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Admin\CreateEmployeeService;

class CreateUserController extends Controller
{
    public function show(){
        return view('admin.create-user');
    }

    public function store(Request $request,CreateEmployeeService $createEmployeeService)
    {
        try {
            $createEmployeeService->createEmployee($request);
            return redirect('/adminHome')->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            
            return redirect('/adminHome')->with('error', 'Failed to create employee.'.$e);
        }
    
    }
    
      

}
