<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function showLoginForm()
    {
        return view('session.login');
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => 'required|exists:employees,email',
            'password' => 'required',
        ]);
        
        if (auth()->attempt($credentials)) {
            
            // Authentication successful
    
            // Check if the authenticated user is an admin
            if (auth()->user()->email === 'mycal@gmail.com') {
                return redirect('/adminHome');
            } else  {
                // For non-admin users, get the employee ID
                $employeeId = auth()->user()->id;
    
                // Fetch the employee details
                $employee = Employee::findOrFail($employeeId);
    
                // Check the 'access' field in the database
                if ($employee->access === 0) {
                    // If 'access' is 0, throw a 403 error
                    abort(403, 'Unauthorized');
                }
    
                // Redirect to the 'user-home' view
                return redirect('/employeeHome');
            }
        }
    
        throw ValidationException::withMessages([
            'email' => 'Your credentials could not be verified',
        ]);
    }


    public function logout(){

        auth()->logout();
        return redirect('/');
    }
}
