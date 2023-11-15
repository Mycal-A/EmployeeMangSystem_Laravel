<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Admin\CreateService;
use App\Http\Services\Admin\UpdateService;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with(['families', 'educations', 'experiences'])->get();
        return response()->json(['data' => $employees]);
    }

    public function show($id)
    {
        $employee = Employee::with(['families', 'educations', 'experiences'])->find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        return response()->json(['data' => $employee]);
    }

    public function store(CreateRequest $request,CreateService $createEmployee)
    {
        try {
            $data = $request->validated();
            $createEmployee->create($data);

            return response()->json(['success' => 'Employee created successfully'], 200);

        }catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, return JSON with error messages
            return response()->json(['error' => $e->errors()], 400);
        }
         catch (\Exception $e) {
            
            return response()->json(['error' => 'Failed to create employee details'.$e], 400);
        }
    
    }

    public function update(UpdateRequest $request, $id,UpdateService $updateEmployee)
    {
        try {
            $data = $request->validated();
            $updateEmployee->update($data, $id);
     
            return response()->json(['message' => 'Employee updated successfully'], 200);

        }catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, return JSON with error messages
            return response()->json(['error' => $e->errors()], 400);
            
        }catch (\Exception $e) {
            
            return response()->json(['error' => 'Failed to update employee details'.$e], 400);
        }

    } 

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        $employee->deleteWithFamilies();
        $employee->deleteWithEducations();
        $employee->deleteWithExperiences();
        return response()->json(['message' => 'Employee deleted'], 200);
    }
}
