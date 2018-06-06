<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupervision extends FormRequest
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
    public function rules(){
        
        return [
            'category' => 'required|integer|exists:supervision_categories,id',
            'facility' => 'required|integer|exists:facilities,id',
        ];
    }

    public function messages(){
        return [
            'category.required' => ':attribute is required',
            'category.integer' => ':attribute must be an integer',
            'category.exists' => ':attribute does not exist',
            'facility.required' => ':attribute is required',
            'facility.integer' => ':attribute must be an integer',
            'facility.exists' => ':attribute does not exist', 
        ];
    }
}
