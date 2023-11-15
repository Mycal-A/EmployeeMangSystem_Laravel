<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Services\Admin\UpdateService;
use App\Http\Requests\Admin\UpdateRequest;
use App\Exports\Employee\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Employees\EmployeesImport;
use App\Imports\Employees\FamiliesImport;
use App\Imports\Employees\BulkUploadClass;


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
        $selectedColumns = ['id','name', 'email', 'location','role', 'salary'];
        return Excel::download(new EmployeesExport($selectedColumns), 'Employees.xlsx');
    }
    public function importEmployeesData(Request $request)
    {
        try {
            // Validate the request to ensure a file is present
            $request->validate([
                'file' => 'required|mimes:xlsx,csv,txt|max:2048', // Adjust the allowed file types and size as needed
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        // Get the file from the request
        $file = $request->file('file');

        // Use the storage path to get the full path of the file
        $filePath = $file->getRealPath();

        try {
            // Import the data using the full file path
            // Excel::import(new EmployeesImport, $filePath, null, \Maatwebsite\Excel\Excel::XLSX);
            Excel::import(new BulkUploadClass, $filePath, null, \Maatwebsite\Excel\Excel::XLSX);
         

            // Redirect with success message
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }


}
