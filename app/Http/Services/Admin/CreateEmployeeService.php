<?php

namespace App\Http\Services\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;

class CreateEmployeeService
{
    public function createEmployee(Request $request)
    {
        DB::transaction(function () use ($request) {
      
            $this->validateEmployeeRequest($request);

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
            foreach ($request->input('families') as $familyData) {
                $families[] = new EmpFamily($familyData);
            }
            $employee->families()->saveMany($families);

            // Create Educations
            $educations = [];
            foreach ($request->input('educations') as $educationData) {
                $educations[] = new EmpEducation($educationData);
            }
            $employee->educations()->saveMany($educations);

            // Create Experiences
            $experiences = [];
            foreach ($request->input('experiences') as $experienceData) {
                $experiences[] = new EmpExperience($experienceData);
            }
            $employee->experiences()->saveMany($experiences);
        });
    }

    protected function validateEmployeeRequest(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6',
            'location' => 'required|string',
            'role' => 'required|string',
            'salary' => 'required|numeric|gte:10000',
            'access' => 'required|in:0,1',
            'families.*.name' => 'required|string',
            'families.*.relationship' => 'required|string',
            'families.*.dob' => 'required|date',
            'educations.*.course' => 'required|string',
            'educations.*.institution' => 'required|string',
            'educations.*.cgpa' => 'required|numeric',
            'educations.*.graduation_year' => 'required|integer|digits:4|between:1900,' . (date('Y') + 10),
            'experiences.*.company' => 'required|string',
            'experiences.*.role' => 'required|string',
            'experiences.*.year_of_experience' => 'required|numeric',
       ]);
    }
}
