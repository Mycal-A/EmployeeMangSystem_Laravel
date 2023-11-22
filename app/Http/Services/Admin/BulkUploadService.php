<?php

namespace App\Http\Services\Admin;

use App\Models\Employee;
use App\Models\EmpFamily;
use App\Models\EmpEducation;
use App\Models\EmpExperience;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Employees\BulkUploadClass;

class BulkUploadService
{
    public function importEmployeesData(Request $request)
    {
        try {
            // Validate the request to ensure a file is present
            $request->validate([
                'file' => 'required|mimes:xlsx,csv,txt',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        // Get the file from the request
        $file = $request->file('file');

        // Use the storage path to get the full path of the file
        $filePath = $file->getRealPath();

        try {
            // Import the data using the full file path
            Excel::import(new BulkUploadClass, $filePath, null, \Maatwebsite\Excel\Excel::XLSX);

            // Redirect with success message
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }

}
