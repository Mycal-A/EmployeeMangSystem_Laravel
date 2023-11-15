<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Admin\CreateService;
use App\Http\Requests\Admin\CreateRequest;

class CreateUserController extends Controller
{
    public function show(){
        return view('admin.create-user');
    }

    public function store(CreateRequest $request,CreateService $createEmployeeService)
    {
        try {           
            // dd($request->all());
            $data = $request->validated();
            $createEmployeeService->create($data);
            return redirect('/adminHome')->with('success', 'Employee created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with validation errors and old input
             
            return back()->withErrors($e->errors())->withInput($request->all());
        }catch (\Exception $e) {
            
            return redirect('/adminHome')->with('error', 'Failed to create employee.');
        }
    
    }
    
      

}
