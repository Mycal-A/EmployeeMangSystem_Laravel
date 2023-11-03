<?php

namespace App\Http\Controllers;

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
        $createEmployeeService->createEmployee($request);

        return redirect('/adminHome')->with('success', 'Employee created successfully.');
    
    }
    
      

}
