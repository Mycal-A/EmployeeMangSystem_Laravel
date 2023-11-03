<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Validation\Rule;
use App\Http\Services\Admin\EmployeeUpdateService;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('admin.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();
        return view('admin.view-employee', compact('employee'));
    }

    public function updateEmployee(Request $request, $id,EmployeeUpdateService $employeeUpdateService)
    {
        try {
            $employeeUpdateService->updateEmployee($request, $id);
            return redirect('/adminHome')->with('success', 'Employee details updated successfully');
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response
            return redirect('/adminHome')->with('error', 'Failed to update employee details.');
        }
    }


    public function destroy(Employee $employee)
    {
        // dd($employee);
        $employee->deleteWithFamilies();
        $employee->deleteWithEducations();
        $employee->deleteWithExperiences();
        
        return redirect('/adminHome')->with('success', 'Employee Deleted Successfully!');
    }

}
