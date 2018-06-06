<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArea extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area-name' => 'required|string|min:3|max:255|unique:supervision_areas,name'
        ];
    }

    public function messages(){
        return [
            'area-name.required' => 'Please Enter Area Name',
            'area-name.min' => 'Area Name must be more than :min characters',
            'area-name.unique' => 'Area already exists'                              
        ];
    }
}
