<?php

namespace App\Http\Controllers;
use App\Models\EmpFamily;
use Illuminate\Http\Request;

class EmpFamilyController extends Controller
{
 
    // Other methods...

    public function deleteFamilyRecord($id)
    {
        // Check if the record exists
        $family = EmpFamily::find($id);

        if ($family) {
            // If the record exists, delete it
            $family->delete();

            // Return a success message
            return response()->json(['status' => 'success', 'message' => 'Record deleted successfully']);
        } else {
            // If the record does not exist, return an error message
            return response()->json(['status' => 'error', 'message' => 'Record not found']);
        }
    }

}
