<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubQuestion extends FormRequest
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
            'sub_question' => 'required|string|min:2',
            'sub_question_type_id' => 'required|integer',
            'sub_supervision_area_id' => 'nullable|integer',
        ];
    }

    public function messages(){
        return [
            'sub_question.required' => 'Please Enter :attribute',
            'sub_question.min' => 'Question must be more than :min characters',                            
            'sub_question_type_id.required' => 'Please Select a question type',
            'sub_supervision_area_id.nullable' => 'Please Select a question Area',
        ];
    }
}