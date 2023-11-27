<?php

namespace App\Http\Services\Admin;

use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;

class UpdateService
{
    public function update($data, $id)
    {
        $employee = Employee::findOrFail($id); 
          
        $employeeData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'location' => $data['location'],            
        ];
    
        if (isset($data['password'])) {
            $employeeData['password'] = bcrypt($data['password']);
        }
        if(auth()->user()?->isAdmin()){
            // User is an admin, include 'role' and 'salary'
            $employeeData['role'] = $data['role'];
            $employeeData['salary'] = $data['salary'];
        }
    
        $employee->update($employeeData);
        // if($employee){dd($employeeData);}
        $this->updateRelatedModels($data, $id, EmpFamily::class, 'families');
        $this->updateRelatedModels($data, $id, EmpEducation::class, 'educations');
        $this->updateRelatedModels($data, $id, EmpExperience::class, 'experiences');
    }
    
    protected function updateRelatedModels($data, $id, $modelClass, $key)
    {
        if (isset($data[$key])) {
            foreach ($data[$key] as $modelData) {
               
                $modelId = $modelData['id'] ?? null;
            
                // dd($modelId);
                if ($modelId) {
                    $model = $modelClass::where('id', $modelId);
                    $model->update($modelData);
                } else {
                    $modelData['employee_id'] = $id;
                    $modelClass::create($modelData);
                }
            }
        }
    }

}
