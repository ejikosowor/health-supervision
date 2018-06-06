<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            'name' => 'required|string|min:10|max:255|unique:users',
            'username' => 'required|string|min:6|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|alpha_num|min:8',
            'role_id' => 'required|integer|exists:roles,id',
            'facility_id' => 'required_if:role_id,4',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Please Enter :attribute',
            'name.min' => 'Name must be more than :min characters',
            'username.required' => 'Please Enter :attribute',
            'username.min' => 'Username must be more than :min characters',
            'password.required' => 'Please Enter :attribute',
            'password.min' => 'Password must be more than :min characters',
            'email.required' => 'Please Enter :attribute',
            'role_id.required' => 'Please Select a role',
            'facility_id.required_if' => 'Please Select a facility',                              
        ];
    }
}
