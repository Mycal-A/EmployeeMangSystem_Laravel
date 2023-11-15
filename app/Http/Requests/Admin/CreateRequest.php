<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules(){
        $rules= [
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:6',
            'location' => 'required|string',
            'role' => 'required|string',
            'salary' => 'required|numeric|gte:10000',
            'access' => 'required|in:0,1',
            'families.*.name' => 'required|string',
            'families.*.relationship' => 'required|string',
            'families.*.dob' => 'required|date',
            'educations.*.course' => 'required|string',
            'educations.*.institution' => 'required|string',
            'educations.*.cgpa' => 'required|numeric',
            'educations.*.graduation_year' => 'required|integer|digits:4|between:1900,' . (date('Y') + 10),
            'experiences.*.company' => 'required|string',
            'experiences.*.role' => 'required|string',
            'experiences.*.year_of_experience' => 'required|numeric',
        ];

        return $rules;
    }

}
