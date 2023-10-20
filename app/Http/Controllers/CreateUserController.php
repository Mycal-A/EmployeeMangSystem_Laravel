<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateUserController extends Controller
{
    public function show(){
        return view('admin.create-user');
    }

    

    public function store(Request $request)
    {
    DB::transaction(function () use ($request) {
        
        // Validate the request data
        $request->validate([
             'name' => 'required|string',
             'email' => 'required|email|unique:employees,email',
             'password' => 'required|string|min:6',
             'location' => 'required|string',
             'role' => 'required|string',
             'salary' => 'required|numeric|gte:10000',
             'access' => 'required|in:0,1',
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

        // Create the employee
        $employee = Employee::create([
         'name' => $request->input('name'),
         'email' => $request->input('email'),
         'password' => bcrypt($request->input('password')),
         'location' => $request->input('location'),
         'role' => $request->input('role'),
         'salary' => $request->input('salary'),
         'access' => $request->input('access'),
        ]);

        // Create Families
        $families = [];
        foreach ($request->input('family') as $familyData) {
            $families[] = new EmpFamily($familyData);
        }

        $employee->families()->saveMany($families);

        // Create Educations
        $educations = [];
        foreach ($request->input('education') as $educationData) {
            $educations[] = new EmpEducation($educationData);
        }
        $employee->educations()->saveMany($educations);

        // Create Experiences
        $experiences = [];
        foreach ($request->input('company') as $experienceData) {
            $experiences[] = new EmpExperience($experienceData);
        }
        $employee->experiences()->saveMany($experiences);
    });

    return redirect('/adminHome')->with('success', 'Employee created successfully.');
    }

}
