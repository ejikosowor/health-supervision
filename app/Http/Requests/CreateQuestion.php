<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestion extends FormRequest
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
            'question' => 'required|string|min:5',
            'question_type_id' => 'required|integer',
            'supervision_area_id' => 'nullable|integer',
        ];
    }

    public function messages(){
        return [
            'question.required' => 'Please Enter :attribute',
            'question.min' => 'Question must be more than :min characters',                            
            'question_type_id.required' => 'Please Select a question type',
            'supervision_area_id.nullable' => 'Please Select a question Area',
        ];
    }
}
