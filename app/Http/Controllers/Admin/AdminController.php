<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Services\Admin\UpdateService;
use App\Http\Services\Admin\BulkUploadService;
use App\Http\Requests\Admin\UpdateRequest;
use App\Exports\Employee\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Employees\EmployeesImport;
use App\Imports\Employees\FamiliesImport;


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

    public function update(UpdateRequest $request, $id,UpdateService $employeeUpdateService)
    {
        try {

            // dd($request->all());
            $data=$request->validated();         
            $employeeUpdateService->update($data, $id);
            return redirect('/adminHome')->with('success', 'Employee details updated successfully');

        }catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with validation errors and old input             
            return back()->withErrors($e->errors())->withInput($request->all());
            
        } catch (\Exception $e) {
            
            return redirect('/adminHome')->with('error', 'Failed to update employee details.'.$e);
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

    public function toggleAccess(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->toggleAccess();

        return back(); // Redirect back to the previous page
    }

    public function downloadEmployeesData() 
    {
        $selectedColumns = ['employee_id','name', 'email', 'location','role', 'salary'];
        return Excel::download(new EmployeesExport($selectedColumns), 'Employees.xlsx');
    }
    public function importEmployeesData(Request $request, BulkUploadService $importService)
    {
        return $importService->importEmployeesData($request);
    }


}
