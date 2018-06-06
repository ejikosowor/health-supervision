<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'role_id' => 'required|integer|exists:roles,id',
            'facility_id' => 'required_if:role_id,4',
        ];
    }

    public function messages(){
        return [
            'role_id.required' => 'Please Select a role',
            'facility_id.required_if' => 'Please Select a facility', 
            'facility_id.exists' => 'Facility does not exist'
        ];
    }
}
