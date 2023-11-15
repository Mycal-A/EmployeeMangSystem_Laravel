<?php

namespace App\Http\Services\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;

class CreateService
{
    public function create($data)
    {
        DB::transaction(function () use ($data) {
      
                // Create the employee
                $employee = Employee::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'location' => $data['location'],
                    'role' => $data['role'],
                    'salary' => $data['salary'],
                    'access' => $data['access'],
                ]);

            // Create Families
            $families = $data['families'] ?? [];
            $employee->families()->createMany($families);
                
            // Create Educations
            $educations = $data['educations'] ?? [];
            $employee->educations()->createMany($educations);
                
            // Create Experiences
            $experiences = $data['experiences'] ?? [];
            $employee->experiences()->createMany($experiences);
            });
    }

}
