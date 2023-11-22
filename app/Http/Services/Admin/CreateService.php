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
                    "employee_id"=> $data["employee_id"],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'location' => $data['location'],
                    'role' => $data['role'],
                    'salary' => $data['salary'],
                    'access' => $data['access'],
                ]);

                $employee_id = $employee->id;
                
                // Loop through each type of record and create them
                $recordTypes = ['families', 'educations', 'experiences'];
    
                foreach ($recordTypes as $recordType) {
                    $records = $data[$recordType] ?? [];
                    // Add 'employee_id' to each record
                    $recordsWithEmployeeId = array_map(function ($record) use ($employee_id) {
                        return array_merge($record, ['employee_id' => $employee_id]);
                    }, $records);
    
                    $employee->{$recordType}()->createMany($recordsWithEmployeeId);
                }

        });
    }

}
