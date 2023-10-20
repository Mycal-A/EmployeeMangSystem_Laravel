<?php

namespace App\Http\Controllers;

use App\Models\EmpEducation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmpEducationController extends Controller
{
    public function deleteEducationRecord($id)
    {
        try {
            // Try to find the EmpEducation record by ID
            $education = EmpEducation::findOrFail($id);

            // If the record exists, delete it
            $education->delete();

            // Return a success message
            return response()->json(['status' => 'success', 'message' => 'Record deleted successfully']);
        } catch (ModelNotFoundException $e) {
            // If the record does not exist, return an error message
            return response()->json(['status' => 'error', 'message' => 'Record not found']);
        }
    }
}

