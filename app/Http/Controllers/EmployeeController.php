<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function show(){
        $employee=auth()->user();
        return view('user.user-home')->with([
            'employee' => $employee]);
    }

    public function toggleAccess(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->toggleAccess();

        return back(); // Redirect back to the previous page
    }

    public function updateEmployee(Request $request, $id)
    {
        // Validate the request data, you can customize the validation rules
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $id,
            'password' => 'nullable|string|min:6',
            'location' => 'required|string',
            'family.*.family_name' => 'required|string',
            'family.*.relationship' => 'required|string',
            'family.*.dob' => 'required|date',
            'education.*.course' => 'required|string',
            'education.*.institution' => 'required|string',
            'education.*.cgpa' => 'required|numeric',
            'education.*.graduation_year' => 'required|integer|digits:4|between:1900,' . (date('Y') + 10),
            'company.*.company' => 'required|string',
            'company.*.role' => 'required|string',
            'company.*.year_of_experience' => 'required|numeric',
        ]);

        // Update employee details
        $employee = Employee::findOrFail($id);
        
        $employeeData = $request->only(['name', 'email', 'location']);
        // Conditionally update the password if provided
        if ($request->filled('password')) {
            $employeeData['password'] = bcrypt($request->input('password'));
        }

        $employee->update($employeeData);

        // Update or create family details
        if ($request->has('family')) {
            foreach ($request->input('family') as $familyData) {
            
                // Use family_id to check if the record exists
                $familyId = $familyData['family_id'] ?? null;
                // dd($familyId);
                if ($familyId) {
                    // If family_id exists, update the record
                    $family = EmpFamily::find($familyId);

                    $family->update($familyData);

                } else {
                    // If family_id is not present, it's a new record, create it
                    $familyData['employee_id'] = $id;
                    EmpFamily::create($familyData);
                
                }
            }
        }

        // Update or create education details
        if ($request->has('education')) {
            foreach ($request->input('education') as $educationData) {
                // Use education_id to check if the record exists
                $educationId = $educationData['education_id'] ?? null;
                // dd($educationId);
                if ($educationId) {
                    // If education_id exists, update the record
                    $education = EmpEducation::find($educationId);
                    $education->update($educationData);
                } else {
                    // If education_id is not present, it's a new record, create it
                    $educationData['employee_id'] = $id;
                    EmpEducation::create($educationData);
                }
            }
        }

        // Update or create education details
        if ($request->has('experience')) {
            foreach ($request->input('experience') as $experienceData) {
                // Use experience_id to check if the record exists
                $experienceId = $experienceData['experience_id'] ?? null;
                // dd($experienceId);
                if ($experienceId) {
                    // If experience_id exists, update the record
                    $experience = EmpExperience::find($experienceId);
                    $experience->update($experienceData);
                } else {
                    // If experience_id is not present, it's a new record, create it
                    $experienceData['employee_id'] = $id;
                    EmpExperience::create($experienceData);
                }
            }
        }

        // Redirect or return a response as needed
        return redirect('/employeeHome')->with('success', 'Employee details updated successfully');
    }
}       
