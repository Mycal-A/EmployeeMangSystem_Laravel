<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use App\Http\Services\Admin\UpdateService;
use App\Http\Requests\Admin\UpdateRequest;

class EmployeeController extends Controller
{

    public function show(){
        $employee=auth()->user();
        return view('user.user-home')->with([
            'employee' => $employee]);
    }

   

    public function update(UpdateRequest $request, $id,UpdateService $userUpdateService)
    {
        try {
            
            $data=$request->validated();
            $userUpdateService->update($data, $id);
            return redirect('/employeeHome')->with('success', 'Employee details updated successfully');

        }catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with validation errors and old input             
            return back()->withErrors($e->errors())->withInput($request->all());
            
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response
            return redirect('/employeeHome')->with('error', 'Failed to update employee details.'.$e);
        }
    }
}       
