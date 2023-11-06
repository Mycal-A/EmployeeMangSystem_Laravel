<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ApiService;

class ApiController extends Controller
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

    public function store(Request $request,ApiService $createEmployee)
    {
        try {
            $createEmployee->createEmployee($request);
            return response()->json(['error' => 'Employee created successfully'], 200);

        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Failed to create employee details'.$e], 404);
        }
    
    }

    public function update(Request $request, $id,ApiService $updateEmployee)
    {
        try {
            $updateEmployee->updateEmployee($request, $id);
     
            return response()->json(['message' => 'Employee updated successfully'], 200);
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Failed to update employee details'.$e], 404);
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
