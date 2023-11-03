<?php

namespace App\Http\Services\User;

use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;

class UserUpdateService
{
    public function updateEmployee(Request $request, $id)
    {
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
            'experience.*.company' => 'required|string',
            'experience.*.role' => 'required|string',
            'experience.*.year_of_experience' => 'required|numeric',
        ]);

        $employee = Employee::findOrFail($id);

        $employeeData = $request->only(['name', 'email', 'location']);
        if ($request->filled('password')) {
            $employeeData['password'] = bcrypt($request->input('password'));
        }

        $employee->update($employeeData);

        $this->updateRelatedModels($request, $id, EmpFamily::class, 'family');
        $this->updateRelatedModels($request, $id, EmpEducation::class, 'education');
        $this->updateRelatedModels($request, $id, EmpExperience::class, 'experience');
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
}
