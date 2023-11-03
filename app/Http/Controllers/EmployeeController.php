<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use App\Http\Services\User\UserUpdateService;

class EmployeeController extends Controller
{

    public function show(){
        $employee=auth()->user();
        return view('user.user-home')->with([
            'employee' => $employee]);
    }

    // public function show()
    // {
    //     // Make an API request to get additional details from ApiController
    //     $apiResponse = Http::get('http://127.0.0.1:8888/api/employee-details');
    //     $employee = $apiResponse->json('data');

    //     // Pass the authenticated user details and API details separately to the view
    //     return view('user.user-home', compact('employee'));
    // }

    public function toggleAccess(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->toggleAccess();

        return back(); // Redirect back to the previous page
    }

    public function updateEmployee(Request $request, $id,UserUpdateService $userUpdateService)
    {
        try {
            $userUpdateService->updateEmployee($request, $id);
            return redirect('/employeeHome')->with('success', 'Employee details updated successfully');
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response
            return redirect('/employeeHome')->with('error', 'Failed to update employee details.');
        }
    }
}       
