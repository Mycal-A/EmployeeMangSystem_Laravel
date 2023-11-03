<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6',
            'location' => 'required|string',
            'role' => 'required|string',
            'salary' => 'required|numeric|gte:10000',
            'access' => 'required|in:0,1',
            'families.*.family_name' => 'required|string',
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

        // Create a new employee
        $employee = Employee::create($request->only([
            'name', 'email', 'password', 'location', 'role', 'salary', 'access'
        ]));;

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


        // Return the created employee
        return response()->json(['data' => $employee], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $id,
            'password' => 'nullable|string|min:6',
            'location' => 'required|string',
            'salary' => 'required|numeric',
            'role' => 'required|string',
            'families.*.family_name' => 'required|string',
            'families.*.relationship' => 'required|string',
            'families.*.dob' => 'required|date',
            'educations.*.course' => 'required|string',
            'educations.*.institution' => 'required|string',
            'educations.*.cgpa' => 'required|numeric',
            'educations.*.graduation_year' => 'required|integer|digits:4|between:1900,' . (date('Y') + 10),
            'experience.*.company' => 'required|string',
            'experiences.*.role' => 'required|string',
            'experiences.*.year_of_experience' => 'required|numeric',
        ]);

        $employee = Employee::findOrFail($id);

        $employeeData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'location' => $request->input('location'),
            'salary' => $request->input('salary'),
            'role' => $request->input('role'),
            'access' => $request->input('access'),
        ];

        if ($request->filled('password')) {
            $employeeData['password'] = bcrypt($request->input('password'));
        }

        $employee->update($employeeData);

        $this->updateRelatedModels($request, $id, EmpFamily::class, 'families');
        $this->updateRelatedModels($request, $id, EmpEducation::class, 'educations');
        $this->updateRelatedModels($request, $id, EmpExperience::class, 'experiences');

        // Return a JSON response indicating success
        return response()->json(['message' => 'Employee updated successfully'], 200);
    }

    protected function updateRelatedModels(Request $request, $id, $modelClass, $key)
    {
        if ($request->has($key)) {
            foreach ($request->input($key) as $data) {
                $modelId = $data[$key . '_id'] ?? null;

                if ($modelId) {
                    $model = $modelClass::find($modelId);
                    $model->update($data);
                } else {
                    $data['employee_id'] = $id;
                    $modelClass::create($data);
                }
            }
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
