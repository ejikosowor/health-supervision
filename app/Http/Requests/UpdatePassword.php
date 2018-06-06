<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                'confirmed'
            ],
        ];
    }

    public function messages(){
        return [
            'current_password.required' => 'Please enter current password',
            'new_password.required' => 'Please enter new password',
            'new_password.min' => 'New password must be more than :min characters long',
            'new_password.confirmed' => 'Passwords do not match',
            'new_password.regex' => 'Must contain at least one number and both uppercase and lowercase letters and a special character'
        ];
    }
}
