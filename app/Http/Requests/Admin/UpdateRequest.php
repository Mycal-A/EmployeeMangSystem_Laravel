<?php

namespace App\Http\Requests\Admin;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules(){
        
        $id = $this->route('employee');
        //dd($id);
        $rules= [
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $id,
            'password' => 'nullable|string|min:6',
            'location' => 'required|string',
           
            'families.*.id' => 'nullable|numeric',
            'families.*.name' => 'required|string',
            'families.*.relationship' => 'required|string',
            'families.*.dob' => 'required|date',
            'educations.*.id' => 'nullable|numeric',
            'educations.*.course' => 'required|string',
            'educations.*.institution' => 'required|string',
            'educations.*.cgpa' => 'required|numeric',
            'educations.*.graduation_year' => 'required|integer|digits:4|between:1900,' . (date('Y') + 10),
            'experiences.*.id' => 'nullable|numeric',
            'experiences.*.company' => 'required|string',
            'experiences.*.role' => 'required|string',
            'experiences.*.year_of_experience' => 'required|numeric',
        ];

        // Check if the authenticated user is an admin
    
        
        if (auth()->user()?->isAdmin()) {
       
            // Additional rules for admin
            $rules = array_merge($rules, [
                'salary' => 'required|numeric',
                'role' => 'required|string',
            ]);
        }
        return $rules;
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(
    //         response()->json([
    //             "message" => $validator->errors()->all()
    //         ], 422)
    //     );
    // }

    

}
