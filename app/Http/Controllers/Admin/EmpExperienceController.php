<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;

class EmpExperienceController extends Controller
{
    public function deleteExperienceRecord($id)
    {
        // Check if the record exists
        $experience = EmpExperience::find($id);

        if ($experience) {
            // If the record exists, delete it
            $experience->delete();

            // Return a success message
            return response()->json(['status' => 'success', 'message' => 'Record deleted successfully']);
        } else {
            // If the record does not exist, return an error message
            return response()->json(['status' => 'error', 'message' => 'Record not found']);
        }
    }
}
